<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kitchen; 
use App\Manager; 
use App\Admin; 
use App\Accountant; 
use App\Center;
use Session;
use App\Unit; 
use App\Pastry;
use App\KitchenShipment; 
use App\CenterShipment; 
use App\ShipmentNotification;
use Carbon\Carbon;
use App\CompleteShipment;
use App\Http\Controllers\MatchMaker;
use App\Http\Controllers\HTMLEngineGenerator;
use App\Http\Controllers\TalkingBird;

class AppEngineController extends Controller
{

	
	function getDifference(){
		$ships = CompleteShipment::where('sorted',1)->take(300)->get();
		$labels = []; 
		$data = []; 
		$colors  =[]; 
		foreach ($ships as $key => $value) {
			$ex = explode('-',$value->title); 
			$diff = $value->expected_amount - $value->received_amount;
			array_push($data,$diff);
			array_push($colors,$this->generateRandomColor());
			array_push($labels,$ex[1]);
		}
		
		return [
			'labels'=>$labels,
			'datasets'=>[ 
					[
					'label'=> ' KES ',
					'data'=>$data, 
					'backgroundColor'=>$colors
					]
				]
			];
		
	}
	function salesPerShipment(){
		$ships = CompleteShipment::where('sorted',1)->take(300)->get();
		$labels = []; 
		$data = []; 
		$colors  =[]; 
		foreach ($ships as $key => $value) {
			$ex = explode('-',$value->title); 
			array_push($data,$value->received_amount);
			array_push($colors,$this->generateRandomColor());
			array_push($labels,$ex[1]);
		}

		return [
			'labels'=>$labels,
			'datasets'=>[ 
					[
					'label'=> ' KES ',
					'data'=>$data, 
					'backgroundColor'=>$colors
					]
				]
			];
		
	}
	public function goToAdminStats(){
		if(Session::has('admin-auth')){
			$datasets = $this->fetchShipmentStats();
			$sales_per_shipment = $this->salesPerShipment();
			$diff = $this->getDifference();
			return view('admin.stats',compact('diff','datasets','sales_per_shipment'));

		}
		else{
			return redirect('/admin');
		}
	}
		public function fetchShipmentStats(){
			$deconstructed = $this->deconstruct(); 
			$sets = $this->getDatasets($deconstructed['names'],$deconstructed['totals']);
			return
			[
				'labels'=>$deconstructed['titles'],
				'datasets'=>$sets,
			];
		}

		function generateRandomColor(){
			$letters = '0123456789ABCDEF';
			$color = '#';
			for ($i=0; $i < 6 ; $i++) { 
				$color .= $letters[rand(0,15)];
			}
			return $color;
		}
		function getDatasets($names,$totals){//expects an array of item names, and an array of arrays that correspond to the values in the name array
			$data = [];
			foreach ($names as  $key => $value) {
				$set = $this->groomValue($value,$totals[$key]);
				array_push($data,$set);
			}
			return $data;
		}
		function groomValue($name,$totalArray){
			return [
				'data'=>$totalArray,
				'label'=>$name,
				'borderColor'=>$this->generateRandomColor(),
				'fill'=>false
			];
		}
		function elementize($desc,$pin){
			$arr = explode($pin,$desc); 
			$n_array= []; 
			foreach ($arr as  $value) {
				array_push($n_array,explode(':',$value)); 
			}
			return $n_array;
		}

		function search($string,$array){
			foreach ($array as $i => $value) {
				if($string ==$value){
					return  $i;
				}
			}
			return -1;
		}
		function zeroedArray($length,$value){
			//returns an array of zeroes with respect to $length
			//functions provides zeroes for datasets that do not have a particular 
			//order on any day
			//expects length = how many zeroes should lead in the array
			//value = the item that should come after the zeroes
			$temp = [];
			if($length !==0){
				for ($i=0; $i < $length; $i++) { 
					array_push($temp,0);
				}
			}
			array_push($temp,$value);
			return $temp;
		}
		 function deconstruct(){
			 //Returns a  json of titles(eg. September 21st), list of names of pastires (n_list eg.['Cake','Samosa']) and list of records of each pastry (v_arr eg. [ [200,400],[500,100] ])
			//the function loops through all the completeShipments and groups the 
			//kitchen items like (cake,samosa) into arrays of their own values on different days 
			$list = CompleteShipment::where('sorted',1)->get(); 
			//n_list looks like this ['Cake','Marble Cake']
			$n_list = []; //an array for the select-pastries that were made in all diff orders available in the database
			//v_arr contains a collection of arrays, where every array represents all the 'received_amounts' of 
			//particular pastries on different days
			//Eg. n_list = ['Cake','Samosa'] and v_arr = [ [200,400,500],[4000,2000,2000] ]
			//all the received_amounts of 'Cake' that have ever been shipped before will be recorded in the v_arr with 
			//index 0(the 0 corresponds to the index of Cake in n_list) which is = [ 200,400,500 ]
			$v_arr =[]; //an array of arrays
			$title_list = []; 
			//an item of list looks like this = ['description'=>'Chapati:30:300,Marble Cake:150:1500', 'expected_amount'=>3000, 'received_amount'=>2000,'shipment_notification_id'=>3,'sorted'=>1,'received_description'=>'Chapati:30:300,Marble Cake:150:1500', 'title'=>'New Kitchen Shipment 7th September'...]
			foreach ($list as  $key => $value) {
				$ex = explode("-",$value->title);
				//$ex[1] looks like '8th September 2019'
				array_push($title_list,$ex[1]);
				$el =$this->elementize($value->received_description,',');
				//$el now looks like this 
				//[ [Chapati,30,300],[Marble Cake,150,1500] ]
				foreach($el as $val){
					$name = $val[0]; 
					$total = $val[2];
					//check n_list to see if a pastry eg. 'Cake' is already in 
					//if it is in, bring out its index in the n_list array
					//else the search() returns -1
					$key_found = $this->search($name,$n_list); 
					if($key_found !== -1 ){
						//Now, if the index of an existing pastry in the list eg. cake is found and returned
						//use it's index to collect it's corresponding value(it's value is an array) in the v_arr 
						$arr_val =$v_arr[$key_found]; 
						$length = count($arr_val);
						if($length == $key){ //the size of the array of pastries in v_arr must always be the same as the index the loop is on
							//normal flow, just push it on
							array_push($v_arr[$key_found],$total);
						}
						else{
							//if the sizes are not the same, just check for the diff , and create a zeroed array 
							//corresponding to the difference
							//This is to make sure that if an item is not ordered on a particular day, and therefore has no "received_amount" 
							//it is replaced by zero, to make the size of all arrays in the v_arr the same,
							//to be able to draw a sensible line graph
							$diff =$key - $length; 
							$zeroed_set = $this->zeroedArray($diff,$total);
							$new_array = array_merge($arr_val,$zeroed_set);
							$v_arr[$key_found] = $new_array;
						}
					}else{
						//if search returns -1, it means the pastry has not yet been registered in the 
						//n_list array, so register it, and add a new array of corresponding index 
						//in v_array (but before that, create zeroes to fit in the days where this particular item was not ordered)
						//Example: if Pie was not ordered on any day of the week until thursday --where it's recieved amount was (5000)
						//Pie will be introduced into n_list  = ['Cake','Samosa','Pie'] and in v_array = [ [200,400,500],[4000,2000], [0,0,5000] ]
						//Not v_array = [ [200,400,500],[4000,2000], [ 5000 ] ]
						//that is what zeroedArray() does
						array_push($n_list,$name); 
						array_push($v_arr,$this->zeroedArray($key,$total));
					}
				}
			}
			return [
				'titles'=>$title_list,
				'names'=>$n_list,
				'totals'=>$v_arr
			];
		}
	 function metExpectations(Request $r){
			$f = CompleteShipment::where('id',$r->id)->first(); 
			$f->update([
				'accountant_id'=>Session::get('acc-auth')->id,
				'received_amount'=>$f->expected_amount,
				'received_description'=>$f->description,
				'sorted'=>1
			]);
			return 'true';
		}
	 function didntMeetExpectations(Request $request){
			$f = CompleteShipment::where('id',$request->id)->first(); 
			$f->update([
				'accountant_id'=>Session::get('acc-auth')->id,
				'received_description'=>$request->received_description,
				'received_amount'=>$request->received_amount,
				'sorted'=>1
			]);
			return 'true';
		}
		function rectByManager(Request $request){
			$not = ShipmentNotification::where('id',$request->id)->first(); 
			$k = KitchenShipment::where('id',$not->kitchen_shipment_id)->first();
			$c = CenterShipment::where('id',$not->center_shipment_id)->first();
			$k->update(['description'=>$request->kitchen_description]); 
			$c->update(['description'=>$request->center_description]);
			return 'true';
		}
		function prepDescForCompletion($desc){//returns compressed string
			//take format (item:amount:price) and change to (item:price:total)
			$desc = explode('<==>',$desc); 
			$full ="";
			foreach ($desc as $key => $value) {
				$val = explode(':',$value);
				$string =$val[0].':'.$val[2].':'.$val[1]*$val[2]; 
				if($full ==""){
					$full = $string;
				}
				else{
					$full = $full.','.$string;
				}

			}
			return $full;
		}
		function streamLineToAcc($item_to_totals_desc,$expected_amount,$title,$shipment_id){
			$new = new CompleteShipment(); 
			$new->description = $item_to_totals_desc; 
			$new->expected_amount = $expected_amount; 
			$new->title = $title; 
			$new->shipment_notification_id = $shipment_id;
			$new->save();
		}
		function changeDescToReadableItems($desc){
			$pieces = $this->elementize($desc,'<==>'); 
			$string = "";
			foreach ($pieces as $key => $value) {
				if($string == ""){
					$string = $value[0].' - '.$value[1];
				}
				else{
					$string = $string.' , '.$value[0].' - '.$value[1];
				}
			}
			return $string;
		}
		function notifyManagers($shipment_notification_id){
		  $headers = "From: PhilEdwardSystems\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
			$match = new MatchMaker($shipment_notification_id);
			$results = $match->start();
			$title = $match->properties->title;
			$desc = $match->properties->kitchenShipment->description;
			if($results['flag'] == 0 ){
				//nothing is wrong, you dont need to notify manager
				//send straight to accountant
				$item_to_totals= $this->prepDescForCompletion($desc); 
				$expected_amount = $match->expectedAmount()['kitchen_estimate']; 
				$this->streamLineToAcc(
					$item_to_totals,
					$expected_amount,
					$title,
					$shipment_notification_id
				);
				$shipment_not = ShipmentNotification::where('id',$shipment_notification_id)->first(); 
				$shipment_not->update(['sorted'=>1]);
			}
			else{
				$admins = Admin::all();
				foreach ($admins as $man) {
					$htmlGen = new HTMLEmailGenerator(
						$match->properties->id,
						$this->prepDescForCompletion($desc),
						$match->expectedAmount()['kitchen_estimate'],
						$match->properties->kitchen,
						$match->properties->center,
						$man->name,
						$results['pairings']
					);
					$msg  = $htmlGen->generateHtml(0);
					mail($man->email,"$title - Turn Out - [ Mismatch ]",$msg,$headers);
				}
				foreach ($match->managers as $man) {
					$htmlGen = new HTMLEmailGenerator(
						$match->properties->id,
						$this->prepDescForCompletion($desc),
						$match->expectedAmount()['kitchen_estimate'],
						$match->properties->kitchen,
						$match->properties->center,
						$man->name,
						$results['pairings']
					);
					$msg  = $htmlGen->generateHtml(0);
					mail($man->email,"$title - Turn Out - [ Mismatch ]",$msg,$headers);
				}
				$talking_bird = new TalkingBird();
				$talking_bird->reportMismatch(
					$match->properties->center,
					$match->properties->kitchen,$title,
					$this->changeDescToReadableItems(
						$match->properties->kitchenShipment->description
					),
					$this->changeDescToReadableItems(
						$match->properties->centerShipment->description
					),
					$match->stringMismatchDetails()
					);
			}
			return "Done!";
		}
	
    public function receiveValuesFromCenter(Request $request){
        $id = (int) explode(':',$request->title)[0];
        $not = ShipmentNotification::where('id',$id)->first();
        $from_kitchen = Kitchen::where('id',$not->kitchen_id)->first();
        $new = new CenterShipment(); 
        $new->description = $request->description;
        $new->center_id = Session::get('center-auth')->id; 
        $new->kitchen_id = $not->kitchen_id;
        $new->kitchen_name = $from_kitchen->name;
        $new->shipment_notification_id = $not->id;
        $new->save();
        $not->update([
            'center_shipment_id'=>$new->id,
            'center_sorted'=>1,
				]);
				return $this->notifyManagers($not->id);
    }
    /**
     * 
     * $request->description  Structure (Item<==>OtherItem<==>OtherItem) @string
     * Item Structure (item name:number of items:price of one of the items)
     * Eg. Cake:34:20 ( 34 cakes , and each cake costs 20 ksh)
     */
    public function receiveValuesFromKitchen(Request $request){
				$kitchen = Session::get('cook-auth');
				if($kitchen){
					$dest = Center::where('name',$request->destination)->first();
					$defaultTime = Carbon::now()->format('l jS \\of F Y h:i:s A');
					$new = new KitchenShipment();
					$new->description = $request->description; 
					$new->center_id = $dest->id;
					$new->kitchen_id = $kitchen->id;
					$new->center_name = $dest->name;
					$new->save();
					$notification = new ShipmentNotification(); 
					$notification->kitchen_shipment_id = $new->id; 
					$notification->kitchen_id = Session::get('cook-auth')->id; 
					$notification->title =" New Kitchen Shipment - ".$defaultTime;
					$notification->kitchen_sorted=1;
					$notification->center_id = $dest->id;
					$notification->save();
					$new->update(['shipment_notification_id'=>$notification->id]);
				}
    }
}
