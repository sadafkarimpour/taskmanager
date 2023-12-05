<!-- Task Table -->

	<div>
		<form id="App" class="container bg-dark p-5 text-center rounded" style="margin-top:100px;width:800px">
			<div class="row form-group m-1 p-1 w-100">
				<?php 
					$c = &get_instance();
					$c->load->model('Task_model');

					$tasks=$c->Task_model->Taskitems();
				?>
				<!-- <b-table striped hover :items="itemes" :fields="fields"></b-table> -->
				<table class="table table-light col striped hover" >
					<thead>
						<tr ></tr>
					</thead>
					<tbody>
						<tr v-for="task in tasks">
							<td v-html="task.id"></td>
							<td v-html="task.datetime"></td>
							<td v-html="task.id_user"></td>
							<td v-html="task.description"></td>
							<td v-html="task.datetime_deadline"></td>
							<td v-html="task.priority"></td>
							<td v-html="task.status"></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row form-group m-1 p-1 w-100">
				<button type="button" class="col btn btn-primary w-25 p-2 mt-3" @click="Addtask()">Add Task</button>
			</div>
		</form>
	</div>



<!-- Task Table -->





<!-- Task Form -->
	<form id="app" class="container bg-dark p-5 text-center rounded" style="margin-top:100px;width:600px">
		<div class="row form-group m-1 p-1 w-100">
			<h3 class="text-light" >Task Form</h3>
		</div>
		<div class="row form-group m-1 p-1 w-100">
			<h3 class="col text-light" ><?php echo $userid ?>نام ارجاع کننده:</h3>
			
		</div>
		
		<div class="row form-group m-1 p-1 w-100">
					<select v-model="selected">
						<option disabled value="-1">Please select the user ID you want to refer Task to.</option>
						<option v-for="group in groups"  v-html="group.name + ' ' + group.lastname" :value="group.id"></option>
					</select>
		</div>

		<div class="row form-group pt-3 m-1  w-100">
			<textarea v-model="Description" class="col form-control p-2" name="Description" id="Description" cols="30" rows="10" placeholder="Enter Description"></textarea>
		</div>
		<div class="row form-group pt-3 m-1  w-100">
			<input v-model="datedeadline" type="date" class="col form-control p-2" id="exampleInputdatedead" >
		</div>
		<div  class="row form-group pt-3 m-1  w-100 tex-dark">
					<select v-model="priority">
						<option disabled value="Please select priority.">Please select priority.</option>
							<option value="High">High</option>
							<option value="Meduim">Meduim</option>
							<option value="Low">Low</option>
					</select>
			</div>
			<div  class="row form-group pt-3 m-1  w-100 tex-dark">
					<select v-model="status">
						<option disabled value="Please select status.">Please select status.</option>
						<option value="Pending">Pending</option>
						<option value="Onprogress">Onprogress</option>
						<option value="Done">Done</option>
					</select>
			</div>
		<button type="button" class="row btn btn-primary w-25 p-2 mt-3" @click="Send()">Send</button>
		
	</form>
<!-- Task Form -->


<script>
	Vue.createApp({
	data(){
		return{
			Description:'',
			datedeadline:'',
			selected:'-1',
			priority:'',
			status:'',
			tasks:[],
			groups: <?php echo json_encode($groups) ?>,
			/*fields:[
					{
						key:'id',
						sortable: true
					},
					{
						key:'datetime',
						sortable: false
					},
					{
						key:'id_user',
						sortable: false
					},
					{
						key:'description',
						sortable: false
					},
					{
						key:'datetime_deadline',
						sortable: false
					},
					{
						key:'priority',
						sortable: false
					},
					{
						key:'status',
						sortable: false
					},
				]*/



			
		}
	},
	mounted(){
		//this.getlist()
		console.log(this.groups)
	},

  	methods:{
		Addtask(){

		},
	    Send(){

		},
		getlist(){
				let url = "<?php echo $PATH?>Task/Taskitems"
				$.ajax({
								url:url,
								type:'POST',
								data:{
								},
								success:(res)=>{
									console.log();
										var data = JSON.parse(res);
										this.tasks=data;
								
								}
						})
				
			},
	}
}).mount('#app');
</script>
