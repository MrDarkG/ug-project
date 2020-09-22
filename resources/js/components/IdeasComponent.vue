<template>
	<div class="">
		<vue-countdown-timer
	      @start_callback="startCallBack('event started')"
	      @end_callback="endCallBack('event ended')"
	      :start-time="now"
	      :end-time="endtime"
	      :interval="1000"
	      :start-label="'დაწყებამდე დარჩა'"
	      :end-label="'დასრულებამდე დარჩა'"
	      label-position="begin"
	      :end-text="'ხმის მიცემა დასრულდა. top 3 იდეა:'"
	      :day-txt="'დღე'"
	      :hour-txt="'საათი'"
	      :minutes-txt="'წუთი'"
	      :seconds-txt="'წამი'">
	    </vue-countdown-timer>
		<ul class="list-group">
		  	<li class="list-group-item d-flex justify-content-between" v-for="idea in ideas">
		  		<div>
		  			
		  			{{ idea.user.name }} : {{ idea.title }} 
		  		</div>
		  		<div>
		  			
			  		<i class="fa fa-thumbs-up text-success fa-xl" aria-hidden="true" @click="addvote(idea.id)"></i>
	 				{{ idea.votes_count }}
		  		</div>
			</li>
		  <li class="list-group-item d-flex" v-if="ended==0">
		  	<input type="text" name="" placeholder="add idea" class="form-control" v-model="ideadtext" v-on:keydown.enter="addIdea">
		  	<button class="btn btn-primary" @click="addIdea">add</button>
		  </li>
		  <li class="list-group-item d-flex" v-else>
		  	<input type="text" name="" placeholder="add idea" class="form-control" v-model="ideadtext" v-on:keydown.enter="addIdea" disabled="">
		  	<button class="btn btn-primary" @click="addIdea">add</button>
		  </li>
		</ul>
	</div>
</template>


<script >
    import VueCountdownTimer from 'vuejs-countdown-timer'
Vue.use(VueCountdownTimer)
	export default{
		props:["ideas","end"],
		data(){
			return {
				ideadtext:"",
				now : new Date(),
				ended:0,
				counting: false,
				endtime: new Date(),
				
			}
		},
		methods:{
			startCallBack: function (x) {
		        console.log(x)
		    },
		    endCallBack: function (x) {
		    	console.log(x)
		    },
			addvote(x){
				if(!this.ended){

					axios.post("idea/vote",{
						"id":x
					}).then(response=>{
						if(response.data["status"]==0){
							this.$notify({
							  group: 'foo',
							  title: 'Idea had been unliked',
							  text: 'Unliked!',
							  type: 'error ',
							});
						}
						else if(response.data["status"]==1){
							this.$notify({
							  group: 'foo',
							  title: 'Idea had been liked',
							  text: 'Liked!',
							  type: 'success',
							});
						}
						else{
							this.$notify({
							  group: 'foo',
							  title: 'Deadline ended',
							  text: 'Deadline ended!',
							  type: 'warn',
							});
						}
					});
				}else{
					this.$notify({
							  group: 'foo',
							  title: 'Voting Finished',
							  text: 'Voting Finished',
							  type: 'warn',
							});
				}
			},
			addIdea(){
				axios.post("idea/store",{
					"title":this.ideadtext
				}).then(response=>{
					if(response.data["status"]==2){
						
						this.$notify({
						  group: 'foo',
						  title: 'Deadline ended',
						  text: 'Deadline ended!',
						  type: 'warn',
						});
					}
					else if(response.data["status"]!=0){
						this.$notify({
						  group: 'foo',
						  title: 'Idea had been posted',
						  text: 'Posted!',
						  type: 'success ',
						});
					}
						
						
				});
				
				this.ideadtext="";
			},
		},
		mounted(){
			if(this.end.end_date){

				this.endtime=this.end.end_date;
				this.ended=new Date<this.endtime;
			}
		}
	};
</script>