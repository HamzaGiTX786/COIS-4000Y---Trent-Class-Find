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
  $neighbour->distance = $distance;
  array_push($this->neighbours,$neighbour);
}
  
}
  
class Map{
  
  private $list;
  private $visited;
  private $shortestpath;
  private $shortestpath_nodes;
  
  function __construct(){
    $this->list = array();
    $this->shortestpath = PHP_INT_MAX;
    $this->shortestpath_nodes = array();
  }
  
  public function AddNode(Node $a){ // adds the buildings to the list of buildings
    array_push($this->list,$a);
  }
  
  public function AddRoute(Node $orgin, Node $des, $distance) // adds an edge between the 2 node
  {
    $orgin->AddDest($des,$distance);
  }
  
  private function BFS(Node $orgin, Node $destination, $path,$dist) //Helper function that actually find the shorest path
  {
    if($dist>$this->shortestpath)
        return;

    if($orgin->name == $destination->name){
        if($dist<$this->shortestpath)
        {
            $this->shortestpath = $dist;
            $this->shortestpath_nodes = explode("-", $path);
        }
        return;
    }
  
    $i = array_search($orgin,$this->list);
    $this->visited[$i] = true;
    foreach($orgin->neighbours as $des){
        $i = array_search($des,$this->list);
        if($this->visited[$i] == false)
            {
                $this->BFS($des, $destination, $path."-".$des->name, $dist + $des->distance);
            }
        }

    $this->visited[$i] = false;
} // end of BFS function
  
  public function FastestRoute(Node $orgin, Node $destination)
  {

  if($orgin == $destination){
    return "Source and destination are same";
  }
  
  $this->visited = array_fill(0,sizeof($this->list),false);

  $path  = $orgin->name;

  $this->BFS($orgin,$destination,$path,0);

  if($this->shortestpath == PHP_INT_MAX)
    return "No path found";
  else
    return $this->shortestpath_nodes;
  } // end of Fastest Route

}// end of Map class
  

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
$Map->AddRoute($GCZ,$LEC,1);


for($i =0; $i < sizeof($Map->FastestRoute($LEC,$GCZ)); $i++){
    if($i+1 == sizeof($Map->FastestRoute($LEC,$GCZ))){
        echo $Map->FastestRoute($LEC,$GCZ)[$i];
    }
    else{
        echo $Map->FastestRoute($LEC,$GCZ)[$i]."-";
    }
}

?>
