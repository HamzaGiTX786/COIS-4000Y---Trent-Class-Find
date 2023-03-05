<?php

include 'library.php';

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
    $endnode = clone $des;
    $orgin->AddDest($endnode,$distance);
  }

  public function GetNode($name){
    foreach ($this->list as $node)
    {
        if($node->name == $name)
        {
            return $node;
        }
    }
  }

  public function GetList(){
    return $this->list;
  }

  private function Dijkstra(Node $orgin, Node $destination) //Helper function that actually find the shorest path
  {
    
      $queue = array();
      $dist = array();
      $prev = array();

      foreach($this->list as $node){
        if($node->name == $orgin->name) //add the origin at the very end to the queue
        {
            $prev[$node->name] = null; // setting all the previous node to null
            continue;
        }
        else{
        $dist[$node->name] = PHP_INT_MAX; // setting all the distnace to infinity
        $prev[$node->name] = null; // setting all the previous node to null
        array_push($queue,$node); // adding all the nodes into the queue
        }
      }
      $dist[$orgin->name] = 0; // giving the origin the shortest distance at the begning
      $u = $orgin; // initilize u

      array_unshift($queue,$orgin); // add origin to front of the queue

      while(sizeof($queue) != 0){ // main loop of the algo

        $smallestdist_node_in_queue = PHP_INT_MAX;
        //  $index = array_search(min($dist),$dist);

         /* foreach($queue as $node){
            if($node->name == $index)
            {
                $u = $node; // set u to the node with the smallest distance in queue
                break;
            }
          }
          */

          foreach($queue as $node)
          {
            if($smallestdist_node_in_queue > $dist[$node->name])
            {
                $smallestdist_node_in_queue = $dist[$node->name];
                $u = $node;
            }
          }
          
          $i = array_search($u,$queue);
          unset($queue[$i]); // remove the node from the queue, also means that node is visited
          if($u->name == $destination->name) // if the current node is the destination node then shortest path has been found.
              break;
            

          foreach($u->neighbours as $v){ // else check all of it neighbours 

            $alt = $dist[$u->name] + $v->distance; // find the distances 
              if($alt < $dist[$v->name]){
                  $dist[$v->name] = $alt; // update the distances 
                  $prev[$v->name] = $u; // update the previous visited node
              }
          }
          //$dist[$u->name] = PHP_INT_MAX; // set the distance of the node just checked to infinity
      }
  
      $this->shortestpath = $dist[$destination->name];
      $path = array();
      $u = $destination;
      while($prev[$u->name] !== null){
          array_unshift($path, $u);
          $u = $prev[$u->name];
      }
      array_unshift($path, $orgin);
      //var_dump($prev);
      $this->shortestpath_nodes = $path;
  } // end of dijkstra
  
  public function FastestRoute(Node $orgin, Node $destination)
  {
      if($orgin == $destination){
          return "Source and destination are same";
      }
      $this->Dijkstra($orgin,$destination);
      if($this->shortestpath == PHP_INT_MAX)
          return "No path found";
      else
          return $this->shortestpath_nodes;
  }

}// end of Map class

//----------------Start of Main------------------------------

$Map = new Map();

$query = "SELECT ID,Neighbours FROM Node";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $nodes = mysqli_fetch_all($result); // get output for the searched item
}

foreach($nodes as $n)
{
    $node = new Node($n[0]);
    $Map->AddNode($node);
}

foreach($nodes as $n){

$queryedge = "SELECT Start_Node,End_Node,Distance FROM Edge WHERE Start_Node = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$queryedge))
    {
        echo "SQL prepare failed";
    }
    else{
        mysqli_stmt_bind_param($stmt,"s",$n[0]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $edges = mysqli_fetch_all($result); // get output for the searched item
    }

foreach($edges as $edge){

    $startnode = $Map->GetNode($edge[0]);
    $endnode = $Map->GetNode($edge[1]);

    $Map->AddRoute($startnode,$endnode,$edge[2]);
}
}



?>


