<template>
  <div class="pokeInfo" v-if="pokemon">
    <div class="card" v-if="show">
      <button type="button" class="close text-right pt-2 pr-2" aria-label="Close" @click="close">
        <span aria-hidden="true">&times;</span>
      </button>

      <h1 class="text-center border-bottom p-2">{{pokemon.name | capitalize}} info</h1>

      <div class="row no-gutters">
        <div class="col-md-4 d-flex align-items-center px-3 border-right">
          <img :src="image + pokemon.id + '.png'" :alt="pokemon.name">
        </div>
        
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title font-weight-bold border-bottom">{{ pokemon.name | capitalize }}</h3>
            <div class="card-text"><span class="font-weight-bold">Experience</span> {{ pokemon.base_experience }}</div>
            <div class="card-text"><span class="font-weight-bold">Height</span> {{ pokemon.height }}</div>
            <div class="card-text"><span class="font-weight-bold">Weight</span> {{ pokemon.weight }}</div>

            <div class="pt-3">
              <h3 class="card-title font-weight-bold border-bottom">Pokemon abilities</h3>
              <span v-for="(value, index) in pokemon.abilities" :key="index" class="px-2">{{ value.ability.name | capitalize }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="pokeInfo" v-else>
    <div class="card">
      <button type="button" class="close text-right pt-2 pr-2" aria-label="Close" @click="close">
        <span aria-hidden="true">&times;</span>
      </button>

      <h1 class="text-center border-bottom p-2">info</h1>

      <div class="row no-gutters">
        <div class="col-md-4 d-flex align-items-center px-3 border-right">
          <img src="images/pokeapi.png" width="100%">
        </div>
        
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title font-weight-bold border-bottom">Pokemon not found!!!</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    pokemonUrl: {
      type: String,
      required: true
    },

    image: {
      type: String,
      required: true
    }
  },

  data() {
    return {
      show: false,
      pokemon: {}
    }
  },

  methods: {
    getPokemon() {
      axios.get(this.pokemonUrl)
      .then( res => {
        this.pokemon = res.data;
        this.show = true;
      })
      .catch( err => {
        this.$Progress.fail();
        this.pokemon = '';
        console.log(err);
      })
    },

    close() {
      this.$emit('close');
    }
  },

  created() {
    this.$Progress.start();
    this.getPokemon();
  },

  mounted() {
    this.$Progress.finish();
  }
}
</script>

<style>
.pokeInfo {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  position: fixed;
  top: 0;
  left: 0;
  padding: 90px 10px 10px;
  width: 100%;
  height: 100vh;
  background: rgba(0, 0, 0, 0.5);
  z-index: 3;
}
</style>