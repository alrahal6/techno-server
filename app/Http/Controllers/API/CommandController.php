<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CommandGenerator;
use Illuminate\Http\Request;
use mysqli;

class CommandController extends Controller
{

    private $db;
    protected $commandGenerator;

    public function __construct()
    {
        $this->db = new mysqli('localhost', env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
        $this->commandGenerator = new CommandGenerator();
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
                $this->commandGenerator->saveEntry($meter,$channel,$item,$value);
                $this->commandGenerator->prepareAndSaveCommand($meter,$channel,$item,$value); 
            }
        }
        return response()->json($response);
    }
    
    


    /*private function prepareAndSaveCommand($meter,$channel,$item,$value) {
        // switch to appropriate item
        $command = "";
        switch($item) {
            case 1:
                // day_month
                $command = $this->commandGenerator->entryDayMonth($channel,$value);
                break;
            case 2:
                //year
                $command = $this->commandGenerator->entryYear($channel,$value);
                break;
            case 3:
                //load_limit
                $command = $this->commandGenerator->entryLoadLimit($channel,$value);
                break;
            case 4:
                //max_current
                $command = $this->commandGenerator->entryMaxCurrent($channel,$value);
                break;
            case 5:
                //monthly_tariff
                $command = $this->commandGenerator->entryMonthlyTariff($channel,$value);
                break;
            case 6:
                //monthly_watts
                $command = $this->commandGenerator->entryMonthlyWatts($channel,$value);
                break;
            case 7:
                //overload_delay_time
                $command = $this->commandGenerator->entryOverloadDelayTime($channel,$value);
                break;
            case 8:
                //tod_one_start
                $command = $this->commandGenerator->entryTodOneStart($channel,$value);
                break;
            case 9:
                //tod_one_end
                $command = $this->commandGenerator->entryTodOneEnd($channel,$value);
                break;
            case 10:
                //tod_two_start
                $command = $this->commandGenerator->entryTodTwoStart($channel,$value);
                break;
            case 11:
                //tod_two_end
                $command = $this->commandGenerator->entryTodTwoEnd($channel,$value);
                break;
            case 12:
                //unbalance_current
                $command = $this->commandGenerator->entryUnbalanceCurrent($channel,$value);
                break;
            default:
            $command = "";
                //
        }
        $this->commandGenerator->saveCommand($meter,$command);
    }*/

    
    

}