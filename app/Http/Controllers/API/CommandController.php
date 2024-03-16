<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mysqli;

class CommandController extends Controller
{

    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
    }

    public function index()
    {
        $response = array();
        $deviceId = 0;
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['device_id'])) {
                $deviceId = $input['device_id'];
            }
            $response['isValid'] = false;
            $response['device_id'] = $deviceId;
            $row = 1;
            if (($handle = fopen("mac_address.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    $row++;
                    for ($c=0; $c < $num; $c++) {
                        if($data[$c] == $deviceId) {
                            $response['isValid'] = true;
                        }
                    }
                }
                fclose($handle);
            }
        } else {
            $response['isValid'] = false;
        }

        return response()->json($response);
    }

    public function login()
    {
        $response = array();
        $deviceId = 0;
        $response['isValid'] = false;
        $response['type'] = 0;
        $response['message'] = "Invalid login";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            //var_dump($data);
            if (isset($data['device_id'])) {
                $deviceId = $data['device_id'];
                if (mysqli_connect_errno()) {
                    echo "Failed to connect with database" . mysqli_connect_error();
                }

                $sql = "select * from login where deviceId = '".$deviceId."' limit 1 ";
                //echo $sql;
                //exit;
                if ($r = mysqli_query($this->db, $sql)) {
                    $row = $r -> fetch_array(MYSQLI_ASSOC);
                    //$response = $r;
                    //var_dump($row);
                    if($row['isActive']) {
                        $response['isValid'] = true;
                    }
                    $response['type'] = $row['type'];
                    $response['message'] = "Login Success";
                    //exit;
                } else {
                    $response['isValid'] = false;
                    $response['type'] = 0;
                    $response['message'] = "Invalid login";
                }
            }
        }
        return response()->json($response);
    }


    public function store(Request $request)
    {
        $response = array();
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            //var_dump($data);
            if(isset($data['command']) and isset($data['app_id'])
                and isset($data['flag']) and isset($data['value'])) {

                if (mysqli_connect_errno()) {
                    echo "Failed to connect with database" . mysqli_connect_error();
                }
                $cmd = str_replace(' ','',$data['command']);

                $sql = "INSERT INTO `commands` (`command`,`app_id`,`flag`,`value`,`dName`,`dAddress`)
                VALUES ('".$cmd."','".$data['app_id']."','".$data['flag']."','".$data['value']."',
                '".$data['dName']."','".$data['dAddress']."')";

                if($r = mysqli_query($this->db, $sql)) {
                    $response = $r;
                    //return 1;
                } /*else {
                    return 2;
                }*/
            }
        }
        return response()->json($response);
    }

    public function metercmd() {
        $response = array();
        $deviceId = 0;
        //$response['isSuccess'] = false;
        //$response['flag'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            //var_dump($data);
            if (isset($data['meter'])) {
                $deviceId = $data['meter'];
                if (mysqli_connect_errno()) {
                    echo "Failed to connect with database" . mysqli_connect_error();
                }

                $sql = "select * from meter_commands where meter = '".$deviceId."'  and flag = 0 ";
                //echo $sql;
                //exit;
                $f = 0;
                if ($r = mysqli_query($this->db, $sql)) {
                    $c = 0;
                    while ($row = $r->fetch_assoc()) {
                        $f = 1;
                        $response[$c++] = array(
                            'id' => $row['id'],
                            'meter' => $row['meter'],
                            'command' => $row['command'],
                            'flag' => $row['flag']
                        );
                    }        
                } 
            }
        }
        //$response['isSuccess'] = $f;
        return response()->json($response);
    }

    public function meterupdcmd() {
        $response = array();
        $deviceId = 0;
        //$response['isSuccess'] = false;
        //$response['flag'] = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            //var_dump($data);
            if (isset($data['id'])) {
                $id = $data['id'];
                if (mysqli_connect_errno()) {
                    echo "Failed to connect with database" . mysqli_connect_error();
                }

                $sql = "update meter_commands set flag = 1 where id = '".$id."' ";
                //echo $sql;
                //exit;
                $f = 0;
                if ($r = mysqli_query($this->db, $sql)) {
                    $c = 0;
                    /*while ($row = $r->fetch_assoc()) {
                        $f = 1;
                        $response[$c++] = array(
                            'id' => $row['id'],
                            'meter' => $row['meter'],
                            'command' => $row['command'],
                            'flag' => $row['flag']
                        );
                    }*/        
                } 
            }
        }
        //$response['isSuccess'] = $f;
        return response()->json($response);
    }

    public function cmdSwitch() {

    }

    public function addCmd() {
        $response = array();
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            //var_dump($data);

            if(isset($data['command']) and isset($data['app_id'])
                and isset($data['flag']) and isset($data['value'])) {

                if (mysqli_connect_errno()) {
                    echo "Failed to connect with database" . mysqli_connect_error();
                }
                
                $sql = "INSERT INTO `techno_spa_integration` (`Line_No`, `Catogery`, `Record_datetime`, `Meter_No`, 
                `Channel_No`, `Pole_No`, `Sub_St_Date`, `Sub_End_Date`, 
                `Pkg_Watts`, `Duration`, `Pkg_St_Time`, `Pkg_End_Time`, 
                `Date_Disconnection`, `Channel_Blocked_Unblocked`, 
                `Meter_Update_datetime`, `Techno_Update_status`, 
                `SPA_Update_Status`)
                VALUES ('a','".$data['app_id']."','".$data['flag']."','".$data['value']."',
                '".$data['dName']."','".$data['dAddress']."')";

                if($r = mysqli_query($this->db, $sql)) {
                    $response = $r;
                } 
                   
                
            }
        }
        return response()->json($response);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function saveuservalue() 
    {
        $response = array();
        if($_SERVER['REQUEST_METHOD']=='POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            //var_dump($data);
            $meter = $data['meter_id'];
            $channel = $data['channel_id'];
            $item = $data['item_id'];
            $value = $data['value'];

            if(isset($meter) and isset($channel)
                and isset($item) and isset($value)) {
                 
                if (mysqli_connect_errno()) {
                    echo "Failed to connect with database" . mysqli_connect_error();
                }
                $this->saveEntry($meter,$channel,$item,$value);
                $this->prepareAndSaveCommand($meter,$channel,$item,$value); 
            }
        }
        return response()->json($response);
    }
    
    private function saveEntry($meter,$channel,$item,$value) {
        $sql = "INSERT INTO `entry_values` (`meter_id`, `channel`, `entry_item_id`, `item_value`)
                VALUES ('".$meter."','".$channel."','".$item."','".$value."')"; 

                if($r = mysqli_query($this->db, $sql)) {
                    $response = $r;
        }
    }


    private function prepareAndSaveCommand($meter,$channel,$item,$value) {
        // switch to appropriate item
        $command = ""; 
        switch($item) {
            case 1:
                // day_month
                $command = $this->entryDayMonth($channel,$value);
                break;
            case 2:
                //year
                $command = $this->entryYear($channel,$value);
                break;
            case 3:
                //load_limit
                $command = $this->entryLoadLimit($channel,$value);
                break;
            case 4:
                //max_current
                $command = $this->entryMaxCurrent($channel,$value);
                break;
            case 5:
                //monthly_tariff
                $command = $this->entryMonthlyTariff($channel,$value);
                break;
            case 6:
                //monthly_watts
                $command = $this->entryMonthlyWatts($channel,$value);
                break;
            case 7:
                //overload_delay_time
                $command = $this->entryOverloadDelayTime($channel,$value);
                break;
            case 8:
                //tod_one_start
                $command = $this->entryTodOneStart($channel,$value);
                break;
            case 9:
                //tod_one_end
                $command = $this->entryTodOneEnd($channel,$value);
                break;
            case 10:
                //tod_two_start
                $command = $this->entryTodTwoStart($channel,$value);
                break;
            case 11:
                //tod_two_end
                $command = $this->entryTodTwoEnd($channel,$value);
                break;
            case 12:
                //unbalance_current
                $command = $this->entryUnbalanceCurrent($channel,$value);
                break;
            default:
            $command = "";
                //
        }
        $this->saveCommand($meter,$command);
    }

    private function saveCommand($meter,$command, $flag = "0") {
        $sql = "INSERT INTO `meter_commands` (`meter`, `command`, `flag`)
                VALUES ('".$meter."','".$command."','".$flag."')"; 

                if($r = mysqli_query($this->db, $sql)) {
                    $response = $r;
        }
    }


    private function entryDayMonth($channel,$value) {
        return $this->getSubEndDtCommand($channel,$value);
    }

    private function entryYear($channel,$value) {
        return $this->getSubEndYrCommand($channel,$value);
    }

    private function entryLoadLimit($channel,$value) {
        return "askjdhg";
    }

    private function entryMaxCurrent($channel,$value) {
        return "askjdhg";
    }

    private function entryMonthlyTariff($channel,$value) {
        return "askjdhg";
    }

    private function entryMonthlyWatts($channel,$value) {
        return str_replace(" ", "",$this->getWattsCommand($value,$channel));
    }

    private function entryOverloadDelayTime($channel,$value) {
        return "askjdhg";
    }

    private function entryTodOneStart($channel,$value) {
        return $this->getPkgStTimeCommand($channel,$value);
    }

    private function entryTodOneEnd($channel,$value) {
        return  $this->getPkgEdTimeCommand($channel,$value);
    }

    private function entryTodTwoStart($channel,$value) {
        return "askjdhg";
    }

    private function entryTodTwoEnd($channel,$value) {
        return "askjdhg";
    }

    private function entryUnbalanceCurrent($channel,$value) {
        return "askjdhg";
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

    private function getPkgTwoStTimeCommand($time,$ch) {
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

    private function getPkgTwoEdTimeCommand($time,$ch) {
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



}