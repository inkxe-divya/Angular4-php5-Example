import { Component} from '@angular/core';
import {Http} from '@angular/http';
import 'rxjs/add/operator/map';
@Component({
  selector: 'app-insert',
  templateUrl: './insert.component.html',
  styleUrls: ['./insert.component.css']
})
export class InsertComponent
{
  public id;
  public name="";
  public address="";
  public list =[];
  public upname="";
  public upaddress="";
  updateform:any=false;

  constructor( private http:Http )
   {
    this.http.get("http://localhost/work/crud.php")
    .map(res =>res.json())
    .subscribe((data ) =>{
      //console.log(data);
     this.list=data;
   });
  }
    onSubmit = function () {
     //console.log(this.name);
     
     var operation=1;
      var body = JSON.stringify({name : this.name, address : this.address,operation: operation});
      this.http.post("http://localhost/work/crud.php", body).subscribe((data) => {});
      
      location.reload();
   }


   Update = function (index,name,address) {
    this.updateform=true;
   this. id=index;
   this.upname=name;
   this.upaddress=address;
  }

  
  cancel= function () {
    this.updateform=false;
  
  }

   onUpdate = function () {
    //console.log(this.name);
 var operation=2;

     var body = JSON.stringify({id:this.id, name:this.upname, address :this.upaddress, operation: operation});
     this.http.post("http://localhost/work/crud.php", body).subscribe((data) => {});
     
     location.reload();
  }


  onDelete = function (index) {
    //console.log(this.name);
    var operation=3;
    var id=index;
    console.log(id);
     var body = JSON.stringify({id:id, operation: operation});
     this.http.post("http://localhost/work/crud.php", body).subscribe((data) => {});
     
     location.reload();
  }



}
