<?php
/**
 * Created by PhpStorm.
 * User: slavomir.sedlak
 * Date: 2019-06-29
 * Time: 21:40
 */

namespace App\Http\Controllers;


use App\Room;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function addRoom(Request $request, RoomService $roomService){
        $data = json_decode($request->getContent());
        $name = $data->name;
        $description = $data->description;
        if(isset($name) && isset($description)){
            $room = new Room();
            $room->setName($name);
            $room->setDescription($description);
            $roomService->addRoom($room);
            return response()->json(['status' => 'true']);
        }
        return response()->json(['status' => false, 'message' => 'Vypln vsetky polia!']);
    }

}
