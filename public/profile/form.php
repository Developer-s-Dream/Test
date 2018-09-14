<?php
	session_start();	
 $_SESSION["nameErr"]=$_SESSION["MailErr"]=$_SESSION["AddErr"]=$_SESSION["MobErr"]=$_SESSION["HobErr"]=$_SESSION["DobErr"]='';

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Student Form</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.error {color: #FF0000;}
input{
    outline:none;
     width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}
input[type=text]:hover,:active
{
border-color:green;

}
input[type=date]:hover,:active
{
border-color:green;

}
.submit:hover,:active{
border:none;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>
<h1 align="center"><u>Student Form</u></h1>

<body bgcolor="dodge" id="bodyy" background='public/images/bg.jpg'>

<span id="bodyyp" style="visibility:hidden;color:green;font-size:25;left:42%;text-align:center;position:relative;">SuccessFully Added Student Details</span><br>
<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="myform" onsubmit="return checkk();"   style="display:inline-block;position:absolute;left:37%;top=10%;width:26%">

Name:<span id="snameSpan" autocomplete="sname" class="error" style="visibility:hidden">*only Alphabets and whitespaces are allowed</span><br><input pattern="^[a-zA-Z \.]*$"  type="text" id="name"  placeholder="Enter Student name" name="sname" required oninvalid="this.setCustomValidity('Username cannot be empty and must be valid.')" onchange="this.setCustomValidity('')" onkeyup="snameValidation()"  value='<?php echo isset($_POST["sname"])?$_POST["sname"]:""; ?>'/> <br><div> <span class="error"><?php echo $_SESSION["nameErr"];?></span></div><br/>
Date of Birth:<span id="dobSpan" class="error" style="visibility:hidden">*DOB must be valid and filled </span><br><input type="date" id="dob"  placeholder="dd-mm-yyyy" name="dob"  required oninvalid="this.setCustomValidity('Date of Birth cannot be empty.')" onchange="this.setCustomValidity('')" value='<?php echo isset($_POST["dob"])?$_POST["dob"]:""; ?>'/> <span class="error"><?php echo $_SESSION['DobErr'];?></span><br>
<div style="display:run-in">Gender:<input  style="width:15%;" type="radio" name="gender" value="MALE"  required  onchange="this.setCustomValidity('')" <?php if(isset($_POST['gender'])){ if($_POST['gender'] == 'MALE') {echo "checked";}} ?>>Male<input  style="border:none;width:15%" type="radio" name="gender" value="FEMALE" required <?php if(isset($_POST['gender'])){ if($_POST['gender'] == 'FEMALE') {echo "checked";}} ?>>Female</div><br>
Mobile:<span id="mobSpan" class="error" style="visibility:hidden">*Number must be a valid Indian Number</span><br><input pattern="^(?:(?:\+|0{0,2})91([\-])?|[0]?)?[6789]\d{9}$" type="text" id="mob" placeholder="Enter Indian Mobile Number" name="mobile" required onkeyup="mobValidation()" oninvalid="this.setCustomValidity('Mobile Number cannot be empty.')" onchange="this.setCustomValidity('')" value='<?php echo isset($_POST["mobile"])?$_POST["mobile"]:""; ?>'> <span class="error"><?php echo $_SESSION["MobErr"];?></span><br><br>
Email:<span id="mailSpan" class="error" style="visibility:hidden">*must be a valid mail</span><br><input type="text" id="mail" placeholder="abc@xyz.com" required oninvalid="this.setCustomValidity('Mail Address cannot  be empty and must be valid')" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  name="mail" onkeyup="mailValidation()" onchange="this.setCustomValidity('')" value='<?php echo isset($_POST["mail"])?$_POST["mail"]:""; ?>'> <span class="error"><?php echo $_SESSION["MailErr"];?></span><br>


<div class="hob" id="hob">Hobbies:<span id="hobSpan" class="error" style="visibility:hidden">*only Alphabets and whitespaces are allowed</span><div id="1"><div id="1"><input pattern="^[a-zA-Z ]+$" style="width:89%" type="text"  class="hobby" onkeyup='hobValidation(this.value)' placeholder="add your hobbie" name="hobbie" required oninvalid="this.setCustomValidity('Hobby cannot be empty and must be valid.')" onchange="this.setCustomValidity('')" value='<?php echo isset($_POST["hobbie"])?$_POST["hobbie"]:""; ?>' /><i   style="margin-left:5px;cursor:pointer;font-size:x-large" class="fa" onclick='addHobbie(this.parentNode.parentNode.id)'>&#xf055</i></div></div></div> <span class="error"><?php echo $_SESSION["HobErr"];?></span><br>
<div class="add" id="addrss">Address:<span id="addSpan" class="error" style="visibility:hidden">*Enter Valid Address</span><div><input pattern="^[\w]+(.)*$" style="width:89%" type="text"  placeholder="add address line" name="address" class="address" required onkeyup='addValidation(this.value)' oninvalid="this.setCustomValidity('Address line cannot be empty.')" onchange="this.setCustomValidity('')" value='<?php echo isset($_POST["address"])?$_POST["address"]:""; ?>'><i style="margin-left:5px;cursor:pointer;font-size:x-large" align="right" class="fa" onclick="addAddress()">&#xf055</i><span onclick="addAddress()"></span></div></div> <span class="error"><?php echo $_SESSION["AddErr"];?></span><br>

<div style="display:run-in">Select Save Using:<input  style="width:15%;" type="radio" name="saveUsing" value="AJAX"  required  onchange="this.setCustomValidity('')" <?php if(isset($_POST['saveUsing'])){ if($_POST['saveUsing'] == 'AJAX') {echo "checked";}} ?>>AJAX<input  style="border:none;width:15%" type="radio" name="saveUsing" value="FETCH" required <?php if(isset($_POST['saveUsing'])){ if($_POST['saveUsing'] == 'saveUsing') {echo "checked";}} ?>>FETCH</div><br>
<div style="position:relative;left:37%"><input style="color:ivory;text-align:center;clear:both;background-color:#4DB6AC;width:auto;" id="save" value="save" class="submit" type="submit"/></div>
</form>

<script type="text/javascript">
var flagFV=0;

function addAddress()
{
  
var base=document.getElementById("addrss");
var newElem = document.createElement("div");
newElem.innerHTML='<input style="width:85%" type="text" pattern="^[A-Za-z0-9]+(.)*$" required onkeyup="addValidation(this.value)" class="address" name="address" placeholder="add address line"  required"/><i style="margin-left:5px;cursor:pointer;font-size:x-large" align="right" class="fa" onclick="addAddress()">&#xf055</i><i style="margin-left:5px;cursor:pointer;font-size:x-large" class="fa del1" onclick="remove(this)">&#xf057</i>';

base.append(newElem);
}


var i=1;
function addHobbie(id)
{
try{
var lastChild=document.getElementById("hob").lastElementChild;
 
        if(id==lastChild.id)
   { 
   i++;
var base=document.getElementById("hob");
var newElem = document.createElement ("div");
newElem.id=i;
newElem.name="hobbie"+"i";
newElem.innerHTML='<div id="none"><input pattern="^[a-zA-Z ]+$" style="width:85%" type="text" name="hobby" class="hobby" onkeyup="hobValidation(this.value)" placeholder="add your hobbie"  required><i style="margin-left:5px;cursor:pointer;font-size:x-large"  id="none" class="fa" onclick="addHobbie(this.parentNode.parentNode.id)">&#xf055</i><i style="margin-left:5px;cursor:pointer;font-size:x-large" onclick="remove(this)" class="del fa">&#xf057</i></div>';

base.appendChild(newElem);
document.getElementById("none").id=i;
    }
    else
    {
    i++;   
            var to=document.getElementById(id);
            var newElem = document.createElement ("div");
            newElem.id=i;
            newElem.name="hobbie"+"i";
            newElem.innerHTML ='<div id="none"><input style="width:85%" type="text" pattern="^[a-zA-Z ]+$" onkeyup="hobValidation(this.value)"  name="hobby" class="hobby" placeholder="add your hobbiiiie"  required><i style="margin-left:5px;cursor:pointer;font-size:x-large"   class="fa" onclick="addHobbie(this.parentNode.parentNode.id)">&#xf055</i><i style="margin-left:5px;cursor:pointer;font-size:x-large" onclick="remove(this)" class="del fa">&#xf057</i>';
            document.getElementById("none").id=i;
             to.insertBefore (newElem, to.secondChild);
    }
  
}
 catch(error){
i++;
var base=document.getElementById("hob");
var newElem = document.createElement ("div");
newElem.id=i;
newElem.name="hobbie"+"i";
newElem.innerHTML='<div id="none"><input style="width:85%" pattern="^[a-zA-Z ]+$" type="text" name="hobby" class="hobby" onkeyup="hobValidation(this.value)" placeholder="add your hobbie"  required ><i style="margin-left:5px;cursor:pointer;font-size:x-large"  id="none" class="fa" onclick="addHobbie(this.parentNode.parentNode.id)">&#xf055</i><i style="margin-left:5px;cursor:pointer;font-size:x-large" onclick="remove(this)" class="del fa">&#xf057</i></div>';
base.appendChild(newElem);
document.getElementById("none").id=i;
 }  
   
}
   function disp()
    {
   document.getElementById('bodyy').innerHTML+='<b style="color:green;font-size:25;color:green;">SuccessFully Saved the details of student</b>';
    }
function snameValidation() {
    flagFV=0;
    var x = document.getElementById("name");
    if((x.value).match(/^[a-zA-Z \.]*$/)){
    document.getElementById("snameSpan").style.visibility="hidden";
    }
    else
    {
    document.getElementById("snameSpan").style.visibility="visible";
    flagFV=1;
    Flag=0;
    }
}
function dobValidation(){
    if(isEmpty(document.getElementById('dob').value))
    {  
        document.getElementById("dobSpan").style.visibility="visible";
        }
    else
    { 
        document.getElementById("dobSpan").style.visibility="hidden";
        }
}
function isEmpty(v) {
   if(v==""){
       return true;
   }
   else
   {
       return false;
   }
};
function mobValidation() {
    flagFV=0;
    var x = document.getElementById("mob");
    if((x.value).match(/^(?:(?:\+|0{0,2})91([\-])?|[0]?)?[6789]\d{9}$/)){
    document.getElementById("mobSpan").style.visibility="hidden";
    }
    else{
    document.getElementById("mobSpan").style.visibility="visible";
    flagFV=1;
    Flag=0;
    }
}

function mailValidation() {
    var x = document.getElementById("mail");
    flagFV=0;
    if((x.value).match(/^\w+([-\.]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){
    document.getElementById("mailSpan").style.visibility="hidden";
    }
    else{
    document.getElementById("mailSpan").style.visibility="visible";
    flagFV=1;
    Flag=0;
    }
}
function hobValidation(value) {
    flagFV=0;
      if((value).match(/^[a-zA-Z ]+$/)){
    document.getElementById("hobSpan").style.visibility="hidden";
    }
    else{
    document.getElementById("hobSpan").style.visibility="visible";
    flagFV=1;
    Flag=0;
    }
}
function addValidation(value) {
    flagFV=0;
    if((value).match(/^[\w]+(.)*$/)){
    document.getElementById("addSpan").style.visibility="hidden";
    }
    else{
    document.getElementById("addSpan").style.visibility="visible";
    flagFV=1;
    Flag=0;
    }
}
function remove(v)
{
v1=v.parentNode;
v1.parentNode.removeChild(v1);
}

$(document).ready(function(){
 
    $(".del").click(function(){
       
        $(this).parent().parent().remove();
    });
     $(".del1").click(function(){
      
        $(this).parent().parent().remove();
    });
        $(".submit").click(function(e){
            $.ajax({success: function(){
            console.log('submitt');
            if(flagFV==0&&Flag==0)
            document.getElementById("bodyyp").style.visibility="hidden";
            else if(flagFV==0&&Flag==1)
            {
              document.getElementById("bodyyp").style.visibility="visible"; 
               document.getElementById('bodyyp').focus();
                $("html, body").animate({ scrollTop: 0 }, "fast");
               Flag=0;
            }
            else
            document.getElementById("bodyyp").style.visibility="hidden";
        }});
    });
});
var count=0;
var Flag=0;
function checkk()
{
    count++;
     console.log('checkk');
    var form = document.getElementById("myform");
    var data = form.querySelectorAll("input");
 
  var x=document.querySelector('input[name="saveUsing"]:checked').value;
  if(x=="AJAX")
  {
     snameValidation();
    console.log("done sname validation");
    mobValidation();
    console.log("done mobValidation");
    mailValidation();
    console.log("done mailValidation");
    var hobArr=document.getElementsByClassName("hobby");
    for(var i=0;i<hobArr.length;i++){
     console.log(hobArr[i].value);
    hobValidation(hobArr[i].value);
    }
       
     var addArr=document.getElementsByClassName("address");
     for(var i=0;i<addArr.length;i++){
     console.log(addArr[i].value);
      addValidation(addArr[i].value);
    } 
  if(flagFV==0)
  {
   console.log('flag='+flagFV);
   var formdata=new FormData(form);   
   var x = new XMLHttpRequest();
     x.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    if(this.responseText){
       //document.getElementById('bodyy').innerHTML=document.getElementById('bodyy').innerHTML;
    console.log('cleared');
    document.getElementById("bodyyp").style.visibility="visible";
    $("html, body").animate({ scrollTop: 0 }, "fast");
    Flag=1;
    return false;
    }
    else
    {
    console.log('nope');
    document.getElementById("bodyyp").style.visibility="hidden";
    return false;
    }
    }
    };
    x.open("POST","phpValidation",true);
    x.send(formdata);
    console.log('done--ajax send');
    return false;
}
else{
    console.log('flag='+flagFV);
    document.getElementById("bodyyp").style.visibility="hidden";
    return false;
}

  }
  else{
     console.log(x+"    "+"validation----else");
     
    if(flagFV==0)
    {
        var data=new FormData(form);
   console.log('flag='+flagFV);
   //console.log('data'+data);
   fetch('phpValidation',{
    method: 'POST',
     credentials: 'include',
    mode: 'cors', // no-cors, cors, *same-origin
    redirect: 'follow', // *manual, follow, error
    referrer: 'no-referrer', // *client, no-referrer
    body:data,
    }).then(function(response) {
        
                     
       return response.text();
    /*var prmse=response.text().then(html => {
          return {
            page_type: 'generic',
            html: html
          }});
          var vall=Promise.resolve(prmse);
          console.log(vall);
          //console.log(response);*/
   
   })
   .then(function(text) {
     if(text!="")
    {
    document.getElementById("bodyyp").style.visibility="visible";
    $("html, body").animate({ scrollTop: 0 }, "fast");
    document.getElementById("bodyyp").focus();
    console.log("cleared using fetch");
    console.log('text'+text);
    //alert(text);
    }
    else
    {  
        console.log("nope --undone at fetch through php--else");
        console.log('text'+text);
    document.getElementById("bodyyp").style.visibility="hidden";
        
    }
    Flag=1;
    });

    }
else{
    console.log('flag='+flagFV);
    document.getElementById("bodyyp").style.visibility="hidden";
    Flag=0;
    }


}
console.log('end');
return false;
}


</script>
<?php session_write_close();?>
</body>
</html>