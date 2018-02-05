<template>
  <div id="otro">
    <div>
      <ul>
        <li><router-link to="/">Home</router-link></li>
      </ul>
    </div>
    <router-view></router-view>
  </div>
</template>
<script>
import CrudEvolution from './CrudEvolution.vue';

import Crud from './Crud.vue';

export default {
  name: 'app',
  components:{CrudEvolution}
}
</script>
<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>