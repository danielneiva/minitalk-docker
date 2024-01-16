<template>
  <header>
    <p style="font-size: 50px; font-weight: bold">Bem vindo ao cadastro de texto!</p>
  </header>

  <main>
      <form class="search-form">
          <div style="display: flex; flex-direction: row">
              <input id="text" type="text" style="height: 50px; font-size: 32px">
              <input type="button"  value="Inserir" style="margin-left: 10px" @click="insertItem()">
          </div>
      </form>
      <div style="width: 500px; padding: 1px; background-color: grey; margin: 30px 0"></div>
      <div style="display: flex; flex-direction: column">
          <div v-for="(item, index) in items" class="card-item">
              <p>{{item}}</p>
              <input type="button" value="Excluir" @click="removeItem(index)">
          </div>
      </div>
  </main>
</template>

<script setup>
import {ref} from "vue";

const items = ref([]);

function insertItem() {
    items.value.push(document.getElementById("text").value);
}

function removeItem(index) {
    items.value.splice(index, 1);
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
