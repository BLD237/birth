<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Collection Form</title>

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
      background-color: #3991f0;
    }
   
.container {
  max-width: 800px;
  margin: 20px auto;


}

.box{
    max-width: 900px;
  display: grid;
  gap: 10px;
  padding: 20px;
  border-radius: 10px;
   box-shadow: #333;
  border: 1px solid #e7e4e4;
  background-color: white;
  overflow-y: scroll;
  max-height: 550px;

}
::-webkit-scrollbar{
    width: 10px;
}
::-webkit-scrollbar-thumb{
    background-color: #888;
    border-radius: 10px;
    
  }
  ::-webkit-scrollbar-thumb:hover{
    background-color: #555;

    
  }
  ::-webkit-scrollbar-track{
    background-color: #f1f1ff;
    
  }
  ::-webkit-scrollbar-button{
    background-color: #f1f1ff;
    display: none;
    
  }



  </style>
<link rel="stylesheet" href="bootstrap.css">
<link rel="stylesheet" href="bootstrap.min.css">
  
</head>
<body style="background-color:#cadff3" >
  <div class="container">
    <div class="row">
    <form id="data-collection-form">
        <div class="box">
            <hr>
    <div class="col">       
      <h2>Child's Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Child's First Name</label>
      <input  class="form-control input-sm" type="text" name="fname" id="child-age" required>

      <label for="child-school">Child's Last Name</label>
      <input  class="form-control input-sm"  type="date" name="lname" id="child-school" required>

      <label for="child-hobbies">Child's Date Of Birth</label>
      <input  class="form-control input-sm" type="text" name="dateofbirth" id="child-hobbies" required>

      <label for="child-hobbies">Child's Date Of Birth</label>
      <select name="gender" id="" class="form-control input-sm" > 
        <option value="male">Male</option>
        <option value="male">female</option>
    </select>

      <label for="child-age">Child's Place of Birth</label>
      <input  class="form-control input-sm" type="text" name="paceofbirth" id="child-age" required>

      <label for="child-school">Child's wieght:</label>
      <input  class="form-control input-sm"  type="number" name="wieght" id="child-school" required>

      <label for="child-hobbies">Child's height</label>
      <input  class="form-control input-sm" type="number" name="hieght" id="child-hobbies" required>
      </div>
      </div>
      <hr>
      <!-- next info -->
      <div class="col">       
      <h2>Father's Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Father's name</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>

      <label for="child-school">Father's address</label>
      <input  class="form-control input-sm"  type="text" id="child-school" required>

      <label for="child-hobbies">Father's place of birth</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>
        
      <label for="child-hobbies">Mother's subdivision</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Father's date of birth</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>

      <label for="child-school">Father's occuppation</label>
      <input  class="form-control input-sm"  type="text" id="child-school" required>

      <label for="child-hobbies">Father's Idcard number</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Father's Phone</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Father's email</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies">
      </div>
      </div>
      <hr>

      <!-- next info -->
      <div class="col">       
      <h2>Mother's Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Mother's name</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>

      <label for="child-school">Mother's address</label>
      <input  class="form-control input-sm"  type="text" id="child-school" required>

      <label for="child-hobbies">Mother's place of birth</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>
      
      <label for="child-hobbies">Mother's subdivision</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Mother's date of birth</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>

      <label for="child-school">Mother's occuppation</label>
      <input  class="form-control input-sm"  type="text" id="child-school" required>

      <label for="child-hobbies">Mother's Idcard number</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Mother's Phone</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-hobbies">Mother's email</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies">
      </div>
      </div>
      <hr>
      <!-- next info -->
      <div class="col">       
      <h2>Location Information</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Nationality*</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>

      <label for="child-age">Hostpital / Health name</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>    
      <label for="child-school">Region</label>
      <select name="gender" id="" class="form-control input-sm" >  
      <option value="">SELECT REGION</option>            
        <option value="CENTRE">CENTRE</option>
        <option value="LITORAL">LITORAL</option>
        <option value="WEST">WEST</option>
        <option value="NORTH WES">NORTH WEST</option>
        <option value="SOUTH WEST">SOUTH WEST</option>
        <option value="EAST">EAST</option>
        <option value="SOUTH">SOUTH</option>
        <option value="NORTH">NORTH</option>
        <option value="FAR NORTH">FAR NORTH</option>
        <option value="ADAMAWA">ADAMAWA</option>
    </select>

      <label for="child-hobbies">division</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Town</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>      
      </div>
      </div>
      <hr>
      <div class="col">       
      <h2>Witness Information/Midwife</h2>
      <div class="form-group pb-4"> 
      <label for="child-age">Nationality*</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>
      <label for="child-age">ID CARD*</label>

      <input  class="form-control input-sm" type="number" id="child-age" required> 

      <label for="child-hobbies">Midwife Name*</label>
      <input  class="form-control input-sm" type="text" id="child-hobbies" required>

      <label for="child-age">Phone*</label>
      <input  class="form-control input-sm" type="number" id="child-age" required>      
      </div>
      </div>
      <button class="btn btn-primary" >SUBMIT</button>
      </div>
      
    </form>
    </div>
</div>
    

  <script>
    document.getElementById('data-collection-form').addEventListener('submit', function(event) {
      event.preventDefault();
      // You can add form data collection and submission logic here
      console.log('Form submitted!');
      // Example: You can fetch form data using document.getElementById('<input-id>').value
    });
  </script>
</body>
</html>