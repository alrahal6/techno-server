<?php

class Omc {
   // MySQL database credentials
    private $hostname; 
    private $username; 
    private $password; 
    private $database; 
    private $mysqli;
    private $sourceTable; 
    private $destinationTable;

  function __construct() {
    $this->hostname = "localhost"; 
    $this->username = "omc"; 
    $this->password = "Omc1234$"; 
    $this->database = "omc"; 
    $this->sourceTable = "techno_spa_integration"; 
    $this->destinationTable = "meter_commands"; 
    $this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);
    if ($this->mysqli->connect_error) {
        die("Connection failed: " . $this->mysqli->connect_error);
    }
  }

  public function copySource() {
    $sourceQuery = "SELECT * FROM $this->sourceTable where Techno_Update_status = 0 order by Line_No ASC";
    //echo $sourceQuery;
    $sourceResult = $this->mysqli->query($sourceQuery);
    if (!$sourceResult) {
        die("Source query failed: " . $this->mysqli->error);
    }

    // Prepare the insert statement for the destination table
    $insertQuery = "INSERT INTO $this->destinationTable (meter, command, flag) VALUES (?, ?, ?)";
    $insertStmt = $this->mysqli->prepare($insertQuery);
    if (!$insertStmt) {
        die("Insert statement preparation failed: " . $this->mysqli->error);
    }
    //$i = 0;
    //$j = 0;
    // Bind parameters for the insert statement
    $insertStmt->bind_param("sss", $meter, $command, $flag);

        while ($row = $sourceResult->fetch_assoc()) {
            $meter = $row['Meter_No'];
            $commands = $this->getCommand($row);
            $flag = 0;
            //echo "i-".$i++;
            foreach($commands as $cmd) {
                //echo "j-".$j++;
                $command = str_replace(" ", "",$cmd);
                //$command = $row['Pkg_Watts'];
                if (!$insertStmt->execute()) {
                    die("Insert statement execution failed: " . $insertStmt->error);
                }
            }
            //$this->updateTechoStatus($row['Line_No']);
        } 
    $insertStmt->close();
    $sourceResult->close();
    $this->mysqli->close();
  }

    private function getCommand($val) {
        $myArr = array();
        $ch = $val['Channel_No'];
        if($val['Pkg_Watts']) {
            $myArr[] = str_replace(" ", "",$this->getWattsCommand($val['Pkg_Watts'],$ch));
        }
        
        if($val['Sub_End_Date']) {
            $dt = explode('-', $val['Sub_End_Date']);
            $dayMonth = sprintf('%02d', (int)$dt[2])."".sprintf('%02d', (int)$dt[1]);
            //echo $dayMonth;
            //$crc = new CRC16();
            //echo $crc->calc("6406008A7e7");
            $myArr[] =  str_replace(" ", "",$this->getSubEndDtCommand($ch,$dayMonth));
            $myArr[] =  str_replace(" ", "",$this->getSubEndYrCommand($ch,$dt[0]));
        }

        if($val['Pkg_St_Time']) {
            $time = explode(':', $val['Pkg_St_Time']);
            $hrmin = sprintf('%02d', (int)$time[0])."".sprintf('%02d', (int)$time[1]);
            $myArr[] = $this->getPkgStTimeCommand($hrmin,$ch);
        }

        if($val['Pkg_End_Time']) {
            $time = explode(':', $val['Pkg_End_Time']);
            $hrmin = sprintf('%02d', (int)$time[0])."".sprintf('%02d', (int)$time[1]);
            $myArr[] = $this->getPkgEdTimeCommand($hrmin,$ch);
        }
        return $myArr;
    }

    private function updateTechoStatus($line) {
        $sourceQuery = "update $this->sourceTable set Techno_Update_status = 1 where Line_No = '".$line."' ";
        $sourceResult = $this->mysqli->query($sourceQuery);
        if (!$sourceResult) {
            die("Source query failed: " . $this->mysqli->error);
        }
    }

    private function getWattsCommand($pkgWatts,$ch) {
        $this->setChannelHexa($ch);
        if($this->channelhexa) {
            return  $this->channelhexa." ".$this->valueAndCrc($this->channelhexa,$pkgWatts);
        }
        return "";
    }

    private function valueAndCrc($hexa,$value) {
        $hexadecimal = dechex($value);
        $hexadecimal = str_pad($hexadecimal, 4, '0', STR_PAD_LEFT);
        return $hexadecimal;
     
    }
    
    private function getSubEndDtCommand($ch,$dayMonth) {
        $this->setDayMonthHexa($ch);
        if($this->dayMonthHexa) {
            return  $this->dayMonthHexa." ".$this->valueAndCrc($this->dayMonthHexa,$dayMonth);
        }
        return "";
    }

    private function getSubEndYrCommand($ch,$year) {
        $this->setYearHexa($ch);
        if($this->yearHexa) {
            return  $this->yearHexa." ".$this->valueAndCrc($this->yearHexa,$year);
        }
        return "";
    }

    private function getPkgStTimeCommand($time,$ch) {
        //setTodWriteString
        if(!$ch) {
            return "";
        }
        $this->setTodWriteString($ch);
        if($this->todWrOne) {
            return  $this->todWrOne." ".$this->valueAndCrc($this->todWrOne,$time);
        }
        return "";
    }

    private function getPkgEdTimeCommand($time,$ch) {
        if(!$ch) {
            return "";
        }
        $this->setTodWriteString($ch);
        if($this->todWrTwo) {
            return  $this->todWrTwo." ".$this->valueAndCrc($this->todWrTwo,$time);
        }
        //return $pkgEdTime;
    }

    private $channelhexa = "";
    private function setChannelHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->channelhexa = "64060080";
                break;
            case 2:
                $this->channelhexa = "64060081";
                break;
            case 3:
                $this->channelhexa = "64060082";
                break;
            case 4:
                $this->channelhexa = "64060083";
                break;
            case 5:
                $this->channelhexa = "64060084";
                break;
            default:
                $this->channelhexa = "";
                break;
        }
    }

    private $dayMonthHexa = "";
    private function setDayMonthHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->dayMonthHexa = "64060087";
                break;
            case 2:
                $this->dayMonthHexa = "64060089";
                break;
            case 3:
                $this->dayMonthHexa = "6406008B";
                break;
            case 4:
                $this->dayMonthHexa = "6406008D";
                break;
            case 5:
                $this->dayMonthHexa = "6406008F";
                break;
            default:
                $this->dayMonthHexa = "";
                break;
        }
    }

    private $todWrOne = "";
    private $todWrTwo = ""; 
    private $todWrThree = "";
    private $todWrFour = "";

    private function setTodWriteString($channelBalanceId) {
        switch ($channelBalanceId) {
            case 1:
                $this->todWrOne = "64060090";
                $this->todWrTwo = "64060091";
                $this->todWrThree = "64060092";
                $this->todWrFour = "64060093";
                break;
            case 2:
                $this->todWrOne = "64060096";
                $this->todWrTwo = "64060097";
                $this->todWrThree = "64060098";
                $this->todWrFour = "64060099";
                break;
            case 3:
                $this->todWrOne = "6406009C";
                $this->todWrTwo = "6406009D";
                $this->todWrThree = "6406009E";
                $this->todWrFour = "6406009F";
                break;
            case 4:
                $this->todWrOne = "640600A2";
                $this->todWrTwo = "640600A3";
                $this->todWrThree = "640600A4";
                $this->todWrFour = "640600A5";
                break;
            case 5:
                $this->todWrOne = "640600A8";
                $this->todWrTwo = "640600A9";
                $this->todWrThree = "640600AA";
                $this->todWrFour = "640600AB";
                break;
        }
    }

    private $yearHexa = "";
    private function setYearHexa($currentChannel) {
        
        switch ($currentChannel) {
            case 1:
                $this->yearHexa = "64060086";
                break;
            case 2:
                $this->yearHexa = "64060088";
                break;
            case 3:
                $this->yearHexa = "6406008A";
                break;
            case 4:
                $this->yearHexa = "6406008C";
                break;
            case 5:
                $this->yearHexa = "6406008E";
                break;
            default:
                $this->yearHexa = "";
                break;
        }
    }

    private function crc16_modbus($msg) {
        $data = pack('H*',$msg);
        $crc = 0xFFFF;
        for ($i = 0; $i < strlen($data); $i++)
        {
            $crc ^=ord($data[$i]);

            for ($j = 8; $j !=0; $j--)
            {
                if (($crc & 0x0001) !=0)
                {
                    $crc >>= 1;
                    $crc ^= 0xA001;
                }
                else $crc >>= 1;
            }
        }   
        return sprintf('%04X', $crc);
    }

    /*
    `Line_No`, `Catogery`, `Record_datetime`, `Meter_No`, 
    `Channel_No`, `Pole_No`, `Sub_St_Date`, `Sub_End_Date`, 
    `Pkg_Watts`, `Duration`, `Pkg_St_Time`, `Pkg_End_Time`, 
    `Date_Disconnection`, `Channel_Blocked_Unblocked`, 
    `Meter_Update_datetime`, `Techno_Update_status`, 
    `SPA_Update_Status`
    */ 

    

}





$omc = new Omc();
$omc->copySource();

?>

