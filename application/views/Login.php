<!-- Login Form -->
<form id="App2" class="container bg-dark p-5 text-center rounded" style="margin-top: 100px;width:500px">
	<div class="row form-group m-1 p-1 w-100">
		<h3 class="text-light" >Login Form</h3>
	</div>
	<div class="row form-group pt-3 m-1  w-100">
		<input v-model="username" type="username" class="col form-control p-2" id="exampleInputusername1" aria-describedby="usernameHelp" placeholder="Enter username">
	</div>
	<div class="row form-group pt-3 m-1  w-100">
		<input v-model="password" type="password" class="col form-control p-2" id="exampleInputPassword1" placeholder="Password">
	</div>
	<button type="button" class="row btn btn-primary w-25 p-2 mt-3" @click="dologin()">Login</button>
	<div class="row form-group pt-3 m-1  w-100">
	<small id="" class="col col-lg-6 col-md-6 col-sm-6form-text text-muted">Not a Registered?</small>
    <a class="col col-lg-6 col-md-6 col-sm-6  " href="<?php echo $SiteurlRegister?>"><small id="" class="form-text text-primary">Click to Register!</small></a>
	</div>
</form>
<!-- Login Form -->


<script>
Vue.createApp({
	data(){
    return{
			username:'',
			password:'',
		}
	},

  methods:{
	dologin(){
		if((this.username)!="" && (this.password)!=""){
        let url = "<?php echo $PATH ?>task/doLogin";
        $.ajax({
          url:url,
          type:"POST",
          data:{
            username:this.username,
            password:this.password,
          },
          cache:false,
          success:(dataResult)=>{
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						Swal.fire("Login successfuly done.");
						location.href = "<?php echo $PATH ?>task/taskIndex";	
										
					}
					else if(dataResult.statusCode==201){
						Swal.fire("Invalid username or Password!");

					}
					
				}
			});
		}
		else{
      
			Swal.fire("Please fill the fields!");

     
		}
	}

  },

}).mount('#App2');

</script>
