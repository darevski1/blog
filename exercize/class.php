<?php



class Car {
    function MoveWheels(){
        echo "Wheel move";
    }


}
if (class_exists("Car")){
    echo "Yeeees";
}else{
    echo "Noo";
}