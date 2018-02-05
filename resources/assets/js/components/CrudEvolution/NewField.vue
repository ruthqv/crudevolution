<template>
	<div class="form-group form-inline">
		<label for="newfield">New Field:</label>
       
        <input type="text" class="form-control" v-model="newField" />
	       
	        <div v-if="newField != '' ">
	        
	        <label for="valueSize">How many values do you need for this {{newField}}?</label>
			<select v-model="valueSize"  class="form-control" >
			  <option v-for="valueSize in selectNumber" v-bind:value="valueSize">
			    {{ valueSize }}
			  </option>
			</select>


			<div v-if="valueSize != ''">
			<label for="newValues">Selected: {{ valueSize }} values for {{newField}}</label>  
				<div v-for="item in valueSize">
					<NewValues
					:field = 'newField'
					></NewValues>
				</div>
			</div>  
		</div>   
	</div>
</template>

<script>
import NewValues from './NewValues.vue';

	export default{
		name:"NewField",

		data(){
			return{

				selectNumber:[1,2,3,4,5,6,7,8,9,10],
				valueSize :'',
				
				newField: [] ,
			}
		},

		components:{
			NewValues,
		}
	}

</script>