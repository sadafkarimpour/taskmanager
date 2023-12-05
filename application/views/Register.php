<!-- Register Form -->
<form id="App" class="container bg-dark p-5 text-center rounded" style="margin-top: 70px;width:550px">
	<div class="row form-group m-1 p-1 w-100">
			<h3 class="text-light">Register Form</h3>
	</div>
  <div class="row form-group pt-3 m-1   w-100">
    <input v-model="username" type="username" class="col form-control p-2" id="exampleInputUsername" aria-describedby="usernameHelp" placeholder="Enter UserName">
  </div>
  <div class="row form-group pt-3 m-1  w-100">
    <input v-model="password" type="password" class="col form-control p-2" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="row form-group pt-3 m-1  w-100">
    <input v-model="name" type="text" class="col form-control p-2" id="exampleInputname" placeholder="Name">
  </div>
  <div class="row form-group pt-3 m-1  w-100">
    <input v-model="lastname" type="text" class="col form-control p-2" id="exampleInputlastname" placeholder="LastName">
  </div>
 

  <button type="button" class="row btn btn-primary w-25 p-2 mt-3" @click="doregister()">Register</button>
  <div class="row form-group pt-3 m-1  w-100">
	<small id="" class="col col-lg-6 col-md-6 col-sm-6form-text text-muted">Have you registered?</small>
    <a class="col col-lg-6 col-md-6 col-sm-6  " href="<?php echo $SiteurlRegister?>"><small id="" class="form-text text-primary">Click to Login!</small></a>
	</div>
</form>
<!-- Register Form -->



<script>
	Vue.createApp({
	data(){
		return{
			username:'',
			password:'',
			name:'',
			lastname:'',
		
			
		}
	},

  	methods:{
		doregister(){
			if(!(this.username) || !(this.password) || !(this.name) || !(this.lastname)){
				Swal.fire("Please fill the fields!");
				return;
			}

			let url = "<?php echo $PATH ?>task/doRegister";
			$.ajax({
				url:url,
				type:'POST',
				data:{
					username:this.username,
					password:this.password,
					name:this.name,
					lastname:this.lastname

				},
				success:(dataResult)=>{
					var data = JSON.parse(dataResult);
					if(data.statusCode==200){
						Swal.fire("Registeration successfuly.");
						location.href = "<?php echo $PATH ?>Task/login";
					}
					else if(data.statusCode==201){
						Swal.fire("Email already Exist");
					}
				}
			});
	}
}

}).mount('#App');

</script>
