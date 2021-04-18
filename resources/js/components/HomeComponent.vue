<template>
  <div class="container">
    <h1>Pokemon list</h1>
    <pokemon-list :url="url" :image="image"></pokemon-list>
  </div>
</template>

<script>
import PokemonListComponent from './PokemonListComponent.vue';

export default {
  components: {
    PokemonListComponent
  },

  data() {
    return {
      url: 'https://pokeapi.co/api/v2/pokemon/',
      image: 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/',
    }
  }
}
</script>