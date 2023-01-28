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
  

$OC = new Node("OC"); 
$CC = new Node("CC");
$LEC = new Node("LEC"); 
$GCZ = new Node("GCZ"); 

$Map = new Map();

$Map->AddNode($CC);
$Map->AddNode($LEC);
$Map->AddNode($OC);
$Map->AddNode($GCZ);

$Map->AddRoute($LEC,$CC,2);
$Map->AddRoute($LEC,$OC,20);
$Map->AddRoute($OC,$GCZ,3);
$Map->AddRoute($CC,$OC,4);
$Map->AddRoute($GCZ,$LEC,3);

$tmp_path = $Map->FastestRoute($LEC,$GCZ);


var_dump($tmp_path);





/*
private function Dijkstra(Node $orgin, Node $destination) //Helper function that actually find the shorest path
{
    $queue = array();
    $dist = array();
    $prev = array();
    foreach($this->list as $node){
        $dist[$node->name] = PHP_INT_MAX;
        $prev[$node->name] = null;
        $queue->insert($node, PHP_INT_MAX);
    }
    $dist[$orgin->name] = 0;
    $queue->insert($orgin, 0);
    while(!$queue->isEmpty()){
        $u = $queue->extract();
        if($u->name == $destination->name)
            break;
        foreach($u->neighbours as $v){
            $alt = $dist[$u->name] + $v->distance;
            if($alt < $dist[$v->name]){
                $dist[$v->name] = $alt;
                $prev[$v->name] = $u;
                $queue->insert($v, $alt);
            }
        }
    }

    $this->shortestpath = $dist[$destination->name];
    $path = array();
    $u = $destination;
    while($prev[$u->name] !== null){
        array_unshift($path, $u);
        $u = $prev[$u->name];
    }
    array_unshift($path, $orgin);
    $this->shortestpath_nodes = $path;
}

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


*/
?>


