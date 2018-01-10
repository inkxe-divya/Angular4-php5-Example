<?php

    namespace crud;
    include "connection.php";

    class A
    {
      public $data;
      public $name;
      public $address;
      public $id;
      
      function __construct()
      {
        $this->data = json_decode(file_get_contents("php://input"));
        $data1=$this->data;
        $this->name = $data1->name;
        $this->address= $data1->address;
        $this->id=$data1->id;
      }
    }
    
    class Crud extends A
    { 
      public function insert($con,$data, $name,$address)
      {
          
        $stmt=$con->prepare("INSERT INTO frm (name,address) values (?,?)");
        $stmt-> bind_param("ss",$name,$address);
        $stmt->execute();
        $stmt->close();
          /*$qry = 'INSERT INTO frm (name,address) values ("' . $name . '","' . $address . '")';
            $qry_res = mysqli_query($con,$qry);*/
      }


      public function update($con,$data, $name,$address,$id)
        {
            
          $stmt=$con->prepare("UPDATE frm SET name= ?, address=? WHERE id= ?");
          $stmt-> bind_param("ssi",$name,$address,$id);
          $stmt->execute();
          $stmt->close();

          /*$qry = "UPDATE frm SET address='$address' WHERE name='$name'";
            $qry_res = mysqli_query($con,$qry);*/
        }

        public function delete ($con,$data, $id)
        {
           
          $stmt=$con->prepare("DELETE FROM frm WHERE id=?");
          $stmt-> bind_param("i",$id);
          $stmt->execute();
          $stmt->close();

          /*$qry = "DELETE FROM frm WHERE name='$name'";
            $qry_res = mysqli_query($con,$qry);*/
        }

        public function fetch($con,$data)
        {
          $s = mysqli_query($con,"select * from frm");
          while ($row = mysqli_fetch_array($s)) 
          {
          $fetchdata[]=$row;
          }
          return $fetchdata;
        }
        public function __destruct()
        {
           $this->name="";
           $this->address="";
        }
    }

    $obj= new Crud();
    $data=$obj->data;
    $name=$obj->name;
    $address=$obj->address;
    $id=$obj->id;
    $callfetch=$obj->fetch($con,$data);
    echo json_encode($callfetch);
    $operation=$data->operation;


    if($operation==1)
    {
      crud::insert($con,$data, $name,$address);
    }

    if($operation==2)
    {
      $obj->update($con,$data,$name,$address,$id);
    }

    if($operation==3)
    {
      $obj->delete($con,$data, $id);
    }
?>