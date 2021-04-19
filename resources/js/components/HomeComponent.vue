<template>
  <div class="container">
    <h1>Pokemon list</h1>
    <pokemon-list :url="url" :image="image" @viewPokemon="viewPokemon"></pokemon-list>
    <pokemon-info v-if="showPokemon" :pokemonUrl="pokemonUrl" :image="image" :showPokemon="showPokemon" @close="close">
    </pokemon-info>
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
      pokemonUrl: '',
      showPokemon: false
    }
  },

  methods: {
    viewPokemon(url) {
      this.pokemonUrl = url;
      this.showPokemon = true;
    },

    close() {
      this.pokemonUrl = '';
      this.showPokemon = false;
    }
  },

  created() {
    this.$Progress.start();
  }
}
</script>