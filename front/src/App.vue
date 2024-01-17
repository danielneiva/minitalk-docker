<template>
  <header>
    <p style="font-size: 50px; font-weight: bold">Bem vindo ao cadastro de texto!</p>
  </header>

  <main>
      <form class="search-form" @submit.prevent="insertItem">
          <div style="display: flex; flex-direction: row">
              <input id="text" type="text" style="height: 50px; font-size: 32px" v-model="textValue">
              <input type="button"  value="Inserir" style="margin-left: 10px" @click="insertItem">
          </div>
      </form>
      <div style="width: 500px; padding: 1px; background-color: grey; margin: 30px 0"></div>
      <div style="display: flex; flex-direction: column">
          <div v-for="(item, index) in items" :key="index" class="card-item">
              <p>{{item.text}}</p>
              <input type="button" value="Excluir" @click="removeItem(item)">
          </div>
      </div>
  </main>
</template>

<script setup>
import {onBeforeMount, ref} from "vue";
import axios from "axios";

const items = ref([]);
const textValue = ref("");

onBeforeMount(() => {
  api.get('text-lists').then((response) => {
    items.value = response.data;
  })
})


const api = axios.create({
    baseURL: "http://localhost:8080/api"
});

function insertItem() {
    api.post('text-lists', {
      text: textValue.value
    }).then((response) => {
      items.value.push({id: response.data.id, text: response.data.text});
      textValue.value = "";
    }).catch((error) => {
      console.log(error);
    })
}

function removeItem(index) {
    api.delete('text-lists/' + index.id).then(() => {
      items.value = items.value.filter(item => item.id !== index.id);
    }).catch((error) => {
      console.log(error);
    })
}
</script>

<style scoped>
.card-item {
    background-color: #BBB;
    border: 1px solid #555;
    color: #333;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
    font-size: 20px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}
</style>
