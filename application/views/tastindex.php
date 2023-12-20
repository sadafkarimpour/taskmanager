<!-- Task Table -->

<div id="app" >
	<form class="container bg-light p-5 text-center rounded" style="width:1000px;--bs-bg-opacity: .2;">
		<div class="row form-group m-1 p-1 w-100">
			<?php 
				$c = &get_instance();
				$c->load->model('Task_model');

				$tasks=$c->Task_model->Taskitems();
			?>
			<table  class="table table-dark border border-dark col striped hover text-light text-center" >
				<thead>
					<tr v-if="view">
					<th class="border border-light" >Task id</th>
					<th class="border border-light" >datetime</th>
					<th class="border border-light" >Description</th>
					<!-- <th class="border border-light" >priority</th>
					<th class="border border-light" >status</th> -->
					<th class="border border-light" >ارجاع /  مشاهده جزییات </th>	
					</tr>
					<tr v-else>
					<th class="border border-light" >Task id</th>
					<th class="border border-light" >datetime</th>
					<th class="border border-light" >Description</th>
					<th class="border border-light" >priority</th>
					<th class="border border-light" >status</th>
					<th class="border border-light" >بازگشت / حذف / ویرایش</th>	
					</tr>
				</thead>
				<tbody>
				<tr v-for="task in tasks" :key="task.id" v-show="!view2">
							<td  class="border border-light"  v-html="task.id"></td>
				
							<td  class="border border-light" v-html="task.datetime"></td>

							<!-- <td v-html="task.id_user"></td> -->

							<td  class="border border-light"  v-html="task.description"></td>
							
							<td  class="border border-light" v-if="view2"  v-html="task.priority"></td>
							
							<td  class="border border-light" v-if="view2"  v-html="task.status"></td>

							<td  class="border border-light" v-else>
								<!-- <button type="button" class="btn btn-primary text-white p-2 m-1" @click="View(task)" style="width:40px;"><i class="fa fa-camera-retro fa-lg" style="font-size:20px;"></i></button>						 -->
								<button type="button" class="btn btn-primary text-white p-2 m-1" @click="View(task)" style="width:80px;">View</button>						
								<button type="button" class="btn btn-primary p-2 m-1"  @click="referral(task)" data-toggle="modal" data-target="#referralModal"  style="width:80px ;">referral</button>						
							</td>
						
							<td  class="border border-light"  v-if="view2">
								<button type="button" class="btn btn-primary p-2 m-1" @click="edit()" style="width:80px ;">Edit</button>						
								<button type="button" class="btn btn-primary p-2 m-1" @click="deletee()" style="width:80px ;">Delete</button>	
								<button type="button" class="btn btn-primary p-2 m-1" @click="returnn()" style="width:80px ;">Return</button>						
					
							</td>
					</tr>
					<tr v-for="task in tasks" :key="task.id" v-show="view2 && task.id === viewid">
							<td  class="border border-light"  v-html="task.id"></td>
				
							<td  class="border border-light" v-html="task.datetime"></td>

							<!-- <td v-html="task.id_user"></td> -->

							<td  class="border border-light" v-if="editing">
								<textarea v-model="Description"  class="form-control p-2 bg-dark text-white" name="Description" id="Description"  cols="30" s="10" placeholder="Enter Description"></textarea>
							</td>
							<td  class="border border-light" v-else  v-html="task.description"></td>


							<td  class="border border-light" v-if="editing">
								<select v-model="priority" class="bg-dark text-white">
									<option disabled value="-2">Please select priority.</option>
									<option value="High">High</option>
									<option value="Meduim">Meduim</option>
									<option value="Low">Low</option>
								</select>
							</td>
							<td  class="border border-light" v-else v-html="task.priority"></td>
							

							<td  class="border border-light" v-if="editing">
								<select v-model="status" class="bg-dark text-white">
									<option disabled value="-3">Please select status.</option>
									<option value="Pending">Pending</option>
									<option value="Onprogress">Onprogress</option>
									<option value="Done">Done</option>
								</select>
							</td>
							<td  class="border border-light" v-else  v-html="task.status"></td>

							
							<td  class="border border-light" v-if="editing">
								<button type="button" class="btn btn-primary p-2 m-1" @click="Saveedit(task)" style="width:80px ;">Save</button>						
								<button type="button" class="btn btn-primary p-2 m-1" @click="returnedit()" style="width:80px ;">Return</button>						
							</td>
							<td  class="border border-light" v-else>
								<button type="button" class="btn btn-primary p-2 m-1" @click="editt(task)" style="width:80px ;">Edit</button>						
								<button type="button" class="btn btn-primary p-2 m-1" @click="deletee()" style="width:80px ;">Delete</button>	
								<button type="button" class="btn btn-primary p-2 m-1" @click="returnview()" style="width:80px ;">Return</button>						
							</td>
					</tr>

	
				</tbody>
			</table>
		</div>
		<div class="row form-group m-1 p-1 w-100">
			<button type="button" class="col btn btn-primary w-25 p-2 mt-3" data-toggle="modal" data-target="#exampleModal" >Add Task</button>
		</div>
	</form>


		
<!-- Task Table -->





<!-- Task Form -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 bg-dark text-center p-3 rounded">
		<div class="modal-header border-0">
			<h5 class="modal-title border-0 text-white" id="exampleModalLabel">Task Form</h5>
			<button type="button" class="close border-0" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
      	<div class="modal-body border-0">
			<div class="container"> 
				<div class="col">
					<div class="row form-group m-1 w-100">
						<textarea v-model="Description" class="col form-control p-2" name="Description" id="Description" cols="30" s="10" placeholder="Enter Description"></textarea>
					</div>
					<!-- <div class=" form-group pt-3 m-1  w-100">
						<input v-model="datedeadline" type="date" class="col form-control p-2" id="exampleInputdatedead" >
					</div> -->
					<div  class="row form-group pt-3 m-1  w-100 tex-dark">
						<select v-model="priority">
							<option disabled value="-2">Please select priority.</option>
								<option value="High">High</option>
								<option value="Meduim">Meduim</option>
								<option value="Low">Low</option>
						</select>
					</div>
					<div  class="row form-group pt-3 m-1  w-100 tex-dark">
						<select v-model="status">
							<option disabled value="-3">Please select status.</option>
							<option value="Pending">Pending</option>
							<option value="Onprogress">Onprogress</option>
							<option value="Done">Done</option>
						</select>
					</div>
				</div>
			</div>
      	</div>
		<div class="modal-footer-centered border-0">
			<!-- <div class="row"> -->
				<button type="button" class="btn btn-secondary w-25 p-2 m-3" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary  w-25 p-2 m-3" @click="Save()">Save</button>
			<!-- </div> -->
		</div>
    </div>
  </div>
</div>

<!-- Task form -->


<!-- referral form -->



<!-- Modal -->
<div class="modal fade" id="referralModal" tabindex="-1" role="dialog" aria-labelledby="referralModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 bg-dark text-center p-3 rounded">
      <div class="modal-header border-0">
        <h5 class="modal-title border-0 text-white" id="referralModalLabel">Referral form</h5>
        <button type="button" class="close border-0 bg-secondary text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body border-0" v-for="task in tasks" :key="task.id">
        <div class="text-white" v-if="task.id==referralid" v-html="task.id">

		</div>
      </div>
      <div class="modal-footer-centered border-0">
        <button type="button" class="btn btn-secondary w-25 p-2 m-3" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary w-25 p-2 m-3">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- referral form -->

</div>


<script>
	Vue.createApp({
	data(){
		return{
			Description:'',
			datedeadline:'',
			priority:'-2',
			status:'-3',
			tasks:[],
			groups: <?php echo json_encode($groups) ?>,
			view:true,
			view2:false,
			viewid:"",
		    editing:false,
			referralid:"",
			
			


			
		}
	},
	mounted(){
		this.getlist()
		console.log(this.groups)
	},

  	methods:{
	    Save(){
			let url="<?php echo $PATH?>Task/Save";
			$.ajax({
				url:url,
				type:"post",
				data:{
					description:this.Description,
					datedeadline:this.datedeadline,
					priority:this.priority,
					status:this.status,

				},
				cache:false,
				success:(dataResult)=>{
					var data = JSON.parse(dataResult);
					if(data.statusCode==200){
						Swal.fire("Task successfuly added.");
						this.getlist();
						location.href = "<?php echo $PATH ?>task/taskindex";	
										
					}
					else if(daya.statusCode==201){
						Swal.fire("something went wrong!");

					}
					
				},
			})

		},
		getlist(){
				let url = "<?php echo $PATH?>Task/Search"
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
	    View(task){
			this.view=false
			this.view2=true
			this.viewid=task.id
			
		},
		returnview(){
			this.view=true
			this.view2=false
		},
		editt(task){
			this.view=false
			this.view2=true
			this.viewid=task.id
			this.editing=true
			this.Description=task.description
			this.priority=task.priority
			this.status=task.status
			
		},
		returnedit(){
			this.view=false
			this.view2=true
			this.editing=false
		},
		Saveedit(task){
			let url="<?php echo $PATH?>Task/Saveedit";
			$.ajax({
				url:url,
				type:"post",
				data:{
					editid:task.id,
					description:this.Description,
					priority:this.priority,
					status:this.status,

				},
				cache:false,
				success:(dataResult)=>{
					var data = JSON.parse(dataResult);
					if(data.statusCode==200){
						Swal.fire("Task successfuly added.");
						this.getlist();
						location.href = "<?php echo $PATH ?>task/taskindex";	
										
					}
					else if(daya.statusCode==201){
						Swal.fire("something went wrong!");

					}
					
				},
			})

		},
		deletee(){
			let url="<?php echo $PATH?>Task/delete";
			$.ajax({
				url:url,
				type:"post",
				data:{
					deletedid:this.viewid,
				},
				cache:false,
				success:(dataResult)=>{
					var data = JSON.parse(dataResult);
					if(data.statusCode==200){
						location.href = "<?php echo $PATH ?>task/taskindex";
						Swal.fire("Task successfuly deleted.");	
										
					}
					else if(daya.statusCode==201){
						Swal.fire("something went wrong!");

					}
					
				},
			})
		},
		referral(task){
			this.referralid=task.id

		}
		
	}
}).mount('#app');
</script>
