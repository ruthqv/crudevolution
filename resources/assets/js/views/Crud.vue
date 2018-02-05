<template>
<div>
  <h1>Complete Crud example with pagination, filters and short, using MongoDB & Bootstrap-Vue components</h1>

  <b-container fluid>
    <div class="pull-right">
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
	  Create Item
	</button>
    </div>

    <!-- User Interface controls -->
    <b-row>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Filter" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search" />
            <b-input-group-button>
              <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
            </b-input-group-button>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Sort" class="mb-0">
          <b-input-group>
            <b-form-select v-model="sortBy" :options="sortOptions">
              <option slot="first" :value="null">-- none --</option>
            </b-form-select>
            <b-input-group-button>
              <b-form-select :disabled="!sortBy" v-model="sortDesc">
                <option :value="false">Asc</option>
                <option :value="true">Desc</option>
              </b-form-select>
            </b-input-group-button>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-col md="6" class="my-1">
        <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
      </b-col>
      <b-col md="6" class="my-1">
        <b-form-group horizontal label="Per page" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table ref="table"
    		 show-empty
             stacked="md"
             :items="items"
             :fields="fields"
             :current-page="currentPage"
             :per-page="perPage"
             :filter="filter"
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc"
             @filtered="onFiltered"
    >

      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click.stop="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>

	     <b-button class="btn btn-primary" @click.prevent="editItem(row.item)">Edit</b-button>
		<b-button class="btn btn-danger" @click.prevent="deleteItem(row.item)">Delete</b-button>


      </template>
      <template slot="row-details" slot-scope="row">
        <b-card>
          <ul>
			<ul id="v-for-row.item.years">
			  <li  v-for="(value, key, index) in row.item.years" v-bind="value">
<!-- 			    {{ key }} : {{value}} : {{index}}
 -->	
 				<strong>{{ key }}</strong>
 				<ul id="v-for-value">
			  	<li  v-for="(val, index) in value"><strong>{{index}}</strong> : {{val}}</li>
				</ul>
			  </li>

			</ul>


          </ul>
        </b-card>
      </template>
    </b-table>

  </b-container>
<!-- create -->

    <!-- Create Item Modal -->
		<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Create Item</h4>
		      </div>
		      <div class="modal-body">


		      		<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createItem">


		      <div class="form-group">
						<label for="name">name:</label>
						<input type="text" name="name" class="form-control" v-model="newItem.name" />
						<span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
					</div>


					<div class="form-group">
						<label for="industry">industry:</label>
						<textarea name="description" class="form-control" v-model="newItem.industry"></textarea>
						<span v-if="formErrors['industry']" class="error text-danger">@{{ formErrors['industry'] }}</span>
					</div>


					<div class="form-group">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>


		      		</form>
		        
		      </div>
		    </div>
		  </div>
		</div>



<!-- edit -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
		      </div>
		      <div class="modal-body">


		      		<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem._id)">


		      			<div class="form-group">
							<label for="name">name:</label>
							<input type="text" name="name" class="form-control" v-model="fillItem.name" />
							<span v-if="formErrorsUpdate['name']" class="error text-danger">@{{ formErrorsUpdate['name'] }}</span>
						</div>
		      			<div class="form-group">
							<label for="industry">industry:</label>
							<input type="text" name="industry" class="form-control" v-model="fillItem.industry" />
							<span v-if="formErrorsUpdate['industry']" class="error text-danger">@{{ formErrorsUpdate['industry'] }}</span>
						</div>

		      			<div class="form-group"  v-for="(value, key) in fillItem.years" v-bind="value">
					
							  			<label for="year">{{key}}</label>

						      			<div class="form-group"  v-for="(va, ind) in value">

												<p><strong>{{ind}}</strong><input  type="text" name="fillItem.years[key][ind]" class="form-control" v-model="fillItem.years[key][ind]"/></p>



											<span v-if="formErrorsUpdate['years']" class="error text-danger">@{{ formErrorsUpdate['years'] }}</span>
										</div>

							<span v-if="formErrorsUpdate['years']" class="error text-danger">@{{ formErrorsUpdate['years'] }}</span>
						</div>
						


					<div class="form-group">
						<button type="submit" class="btn btn-success">Submit</button>
					</div>


		      		</form>


		      </div>
		    </div>
		  </div>

		</div>
</div>
</template>

<script>
const items = [
  {"name": "Company1",
  "industry":"manufacturing"}]
import bInputGroup from 'bootstrap-vue/es/components/input-group/input-group';

export default {
  data () {
    return {
      allyears : this.getarray(),

      fillItem : {'name':'','industry':'', 'years':{} },
 
      newItem : {'name':'','industry':'', 'years':{}  },

      formErrors:{},
   	  formErrorsUpdate:{},
      items: items,
      fields: [
        { key: 'industry', label: 'industry', sortable: true  },
        { key: 'name', label: 'name', sortable: true },
        { key: 'actions', label: 'Actions' }
      ],
      currentPage: 1,
      perPage: 5,
      totalRows: items.length,
      pageOptions: [ 1, 5, 10, 15 ],
      sortBy: null,
      sortDesc: false,
      filter: null,
      modalInfo: { title: '', content: '' }
    }
  },
  mounted(){
    this.getItems()
  	// this.getarray();
  },

  computed: {


    sortOptions () {
      // Create an options list from our fields
      return this.fields
        .filter(f => f.sortable)
        .map(f => { return { text: f.label, value: f.key } })
    }
  },
  methods: {

		getarray(){
			var array =[]
			for (let [key, val] of Object.entries(items)) {
			// console.log(val)
			  array.push(val.years);
			}
			// console.log(array)
			return array
		},

  getItems: function(item){
      this.$http.get('api/crud/').then(() => {
      console.log(response.data)
      this.items= response.data
        
        }, (response) => {
        });
    },
    resetModal () {
      this.modalInfo.title = ''
      this.modalInfo.content = ''
    },
    onFiltered (filteredItems) {
      // Trigger pagination to update the number of buttons/pages due to filtering
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },

	 editItem: function(item){
	 	  this.fillItem._id = item._id;
	 	  this.fillItem.name = item.name;
          this.fillItem.industry = item.industry;
          this.fillItem.years = item.years;

	      $("#edit-item").modal('show');
	  },

      updateItem: function(item){
        var input = this.fillItem;

       	console.log(this.fillItem.newyear)
        this.$http.put('api/crud/'+ item.$oid, input).then((response) => {
        	this.items= response.data
        	// console.log(response)
            $("#edit-item").modal('hide');

   			 this.$refs.table.refresh();

          }, (response) => {
              this.formErrorsUpdate = response.data;
          });
      },
      deleteItem: function(item){
      	console.log(item._id)
        this.$http.delete('api/crud/'+item._id.$oid).then((response) => {
        	this.items= response.data

        });
      },
        createItem: function(){
        	this.newItem.years =
    {"2000" : {
			"inversion_recived":"",
			"capital" : "",
			"sales" : "",
			"employees" : ""
		},

		"2001" : {
			"inversion_recived":"",
			"capital" : "",
			"sales" : "",
			"employees" : ""
		},
		"2002" : {
			"inversion_recived":"",
			"capital" : "",
			"sales" : "",
			"employees" : ""
		},
		"2003" : {
			"inversion_recived":"",
			"capital" : "",
			"sales" : "",
			"employees" : ""
		},		
		"2004" : {
			"inversion_recived":"",
			"capital" : "",
			"sales" : "",
			"employees" : ""
		},
		"2005" : {
			"inversion_recived":"",
			"capital" : "",
			"sales" : "",
			"employees" : ""
		}}
        	console.log(this.newItem)
		  var input = this.newItem;
		  this.$http.post('api/crud',input).then((response) => {
        	this.items= response.data
			$("#create-item").modal('hide');
			this.$refs.table.refresh();

		  }, (response) => {
			this.formErrors = response.data;
	    });
	},
  },
  components:{
	'b-input-group-button': bInputGroup
  }
}
</script>
