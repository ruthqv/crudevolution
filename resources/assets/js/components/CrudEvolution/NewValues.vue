<template>
<div>
	<div class="form-group">
		<label for="newfield">New Values:</label>
		Value
        <input  type="text" v-bind:name="name" class="form-control" v-model="values"/>
	</div>
	
<!-- 		<InputfinalVals :finalfield="name"  ></InputfinalVals>
 -->			
	</div>
</div>

</template>
<script>

// import Vue from 'vue'
// var bus = new Vue()

// Vue.component('InputfinalVals', {
//   template: `<input type="text" v-bind:name="finalname" class="form-control" v-model="finalvalue"/>`,
//   props:['finalfield'],

//  data() {
//     return {
// 			finalvalue: '' ,
// 			finalname : this.finalfield[this.$parent.values] + '[]',
// 			newData : []
// 			}
//   },

// watch:{
// 	finalname:function(){
// 		console.log(this.finalname)
// 	}
// }

// });


// def

	export default{
	name:"NewValues",
	props: ['field'],
	data(){
		return{
			values: '',
			name : this.field + '[]',
		}
	},
}

</script>