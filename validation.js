function formValidation()
{
  var error_value = 0;
  var uname = document.registration.name;
  var uemail = document.registration.email;
  var passid = document.registration.password;
  var passid2 = document.registration.password2;
  var uzip = document.registration.contact;
  var uadd = document.registration.address;
  var cadd = document.registration.current_address;
  var umsex = document.registration.male;
  var ufsex = document.registration.female;
  var uothers = document.registration.others;
  var ucourse = document.registration.use_course;


 
if(!allLetter(uname))
{
  document.getElementById('errorN').innerHTML = '*required and consists of atleast 3 alphabets';
    error_value++;
}
else
{
  document.getElementById('errorN').innerHTML = '';
}
if(!ValidateEmail(uemail))
{
  document.getElementById('errorE').innerHTML = '*required and enter valid email';
  error_value++;
}
else
{
  document.getElementById('errorE').innerHTML = '';
}
if(!passid_validation(passid,8,12))
{
  document.getElementById('errorP').innerHTML = '*required and consists of 8 to 12 letters';
  error_value++;
}
else
{
  document.getElementById('errorP').innerHTML = '';
  
}

if(!passid_validation2(passid2,8,12))
{
  document.getElementById('errorP2').innerHTML = '*required and consists of 8 to 12 letters';
  error_value++;
}
else
{
  document.getElementById('errorP2').innerHTML = '';
}
if(!matchPassword(passid,passid2))
{ document.getElementById('errorPC').innerHTML = '*required and password did not match';
  error_value++;
}
else
{
  document.getElementById('errorPC').innerHTML = '';
  
}
if(!allnumeric(uzip))
{
  document.getElementById('errorCT').innerHTML = 'required and consists of 11 numbers';
  error_value++;
}
else
{
  document.getElementById('errorCT').innerHTML = '';
}
if(!alphanumeric(uadd))
{
  document.getElementById('errorAD').innerHTML = '*required';
  error_value++;
}
else
{
  document.getElementById('errorAD').innerHTML = '';
  
}
if(!alphanumeric(cadd))
{
  document.getElementById('errorAD2').innerHTML = '*required';
  error_value++;
}
else
{
  document.getElementById('errorAD2').innerHTML = '';
  
}

if(!validsex(umsex,ufsex,uothers))
{
  document.getElementById('errorG').innerHTML = '*required';
  error_value++;
}
else
{
  document.getElementById('errorG').innerHTML = '';
  
}
if(!courseselect(ucourse))
{
  document.getElementById('errorU').innerHTML = '*required';
  error_value++;
}
else
{
  document.getElementById('errorU').innerHTML = '';
  
}
if(error_value != 0)
{
  return false;
}
 
if(!confirmSubmit())
{
  return false;
}

return true;
}


function allLetter(uname)      //all-letter
{ 
  var letters = /^[A-Za-z\s]+$/;
  if((uname.value.match(letters)) && (uname.value.length >= 3))
  {
    return true;
  }
  else
  {
   
    uname.focus();
    return false;
  }
}


function ValidateEmail(uemail)      //Email
{
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if(uemail.value.match(mailformat))
  {
    return true;
  }
  else
  {
   
    uemail.focus();
    return false;
  }
}


function passid_validation(passid,mx,my)        //password
{
  var passid_len = passid.value.length;
  if (passid_len == 0 ||passid_len >= my || passid_len < mx)
  {
   
    passid.focus();
    return false;
  }
return true;
}

function passid_validation2(passid2,mx,my)        //password
{
  var passid_len = passid2.value.length;
  if (passid_len == 0 ||passid_len >= my || passid_len < mx)
  {
   
    passid2.focus();
    return false;
  }
return true;
}

function matchPassword(passid,passid2) {  
    
  if(passid.value != passid2.value)  
  {   
        
    return false;
  } 
  return true;    
  }  


function allnumeric(uzip)      //numeric contact
{ 
  var numbers = /^[0-9]+$/;
  if((uzip.value.match(numbers)) && (uzip.value.length === 11))
  {
    return true;
  }
  else
  {
    
    uzip.focus();
    return false;
  }
}


function alphanumeric(uadd)       //alphatnumeric
{ 
  var y = uadd.value;
  if(y == "")
  {
    
    uadd.focus();
    return false;
  }
  else
  {
   return true;
  }
}



function validsex(umsex,ufsex,uothers)        //gender
{
  x=0;

  if(umsex.checked) 
  {
    x++;
  } 
  if(ufsex.checked)
  {
    x++; 
  }
  if(uothers.checked) 
  {
    x++;
  }
  if(x==0)
  {
    
    umsex.focus();
    return false;
  }
  else
  {
    return true;
  }
}


function courseselect(ucourse)      //Course
{
  if(ucourse.value == "Default")
  {
    
    ucourse.focus();
    return false;
  }
  else
  {
    
    return true;
  }
}



function confirmSubmit()
{
  var agree=confirm("Are you sure you wish to continue?");
  if (agree)
  return true ;
  else
  return false ;
}


function myFunction() 
{
    var x = document.getElementById("myInput");
    var y = document.getElementById("myInput2");
    if (x.type === "password" || y.type === "password")
   {
      x.type = "text";
      y.type = "text";
    }      
    else 
    {
      x.type = "password";
      y.type = "password";
    }
  }

  function addressFunction() {
    if (document.getElementById(
      "same").checked) {
        document.getElementById(
          "current_address").value = 
        document.getElementById(
          "address").value;
        
    }
    else {
        document.getElementById(
          "current_address").value = "";
    }
}

