<?php

class Node{
  public $name; 
  public $neighbours = array();
  public $distance;

  function __construct(String $name) {
    $this->name = $name;
  }

  public function AddDest(Node $neighbour,$distance)
  {
    $this->distance = $distance;
    array_push($this->neighbours,$neighbour);
  }


}

class Map{

    private $list;
    private $visited;
    private $shortestpath;



    function __construct() {
        $this->list = array();
        $this->shortestpath = 10000;
    }

    public function AddNode(Node $a){ // add the building in the list of other buildings
       array_push($this->list,$a);
    }

    public function AddRoute(Node $orgin, Node $des, $distance) // add a route b/w origin and destination 
    {
        $orgin->AddDest($des,$distance);
    }

    private function BFS(Node $orgin, Node $destination, String $path) // helping function that find the shortest path
    {
        foreach($orgin->neighbours as $des){
        
            $i = array_search($des,$this->list);

            if($this->visited[$i] == false)
            {
                if($des->distance < $this->shortestpath) {
                    $this->shortestpath = $des->distance;
                    $path = $path." - ".$des->name;
                }
                if($des == $destination){
                    $this->visited[$i] = true;
                    return $path;
                }
                $this->visited[$i] = true;
            }  
        }

        foreach($orgin->neighbours as $des){
            
            $tmp = $this->BFS($des, $destination, $path);

            if($tmp != null){
                return  $tmp;
            }
        }
        return null;
    }


    public function FastestRoute(Node $orgin, Node $destination) // function that calls the shortest path 
    {
    if($orgin == $destination){
        return "Source and destination are same";
    }

    $this->visited = array(sizeof($this->list));
    $path  = $orgin->name;


    for($i =0; $i< sizeof($this->list); $i++){
            $this->visited[$i] = false;
    }

    $tmp = $this->BFS($orgin,$destination,$path);

    return $tmp;
    }

    
}

$OC = new Node("OC");
$CC = new Node("CC");
$LEC = new Node("LEC");
$GCZ = new Node("GCZ");

$Map = new Map();

$Map->AddNode($CC);
$Map->AddNode($LEC);
$Map->AddNode($OC);
$Map->AddNode($GCZ);

$Map->AddRoute($LEC,$CC,5);
$Map->AddRoute($LEC,$OC,2);
$Map->AddRoute($OC,$GCZ,3);
$Map->AddRoute($CC,$OC,4);



echo $Map->FastestRoute($LEC,$GCZ);

?>