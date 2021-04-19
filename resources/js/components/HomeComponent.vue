<template>
  <div class="container" v-if="isAuthenticated">
    <div class="card p-5">
      <div class="card-header">
        <h1>Pokemon list</h1>
      </div>
      <div>
        <search-component :url="url" @viewPokemon="viewPokemon"></search-component>
        <pokemon-list :url="url" :image="image" @viewPokemon="viewPokemon"></pokemon-list>
      </div>
    </div>
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