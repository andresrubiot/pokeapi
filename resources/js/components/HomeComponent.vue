<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="row row-cols-1 row-cols-md-4">
          <div class="col mb-4">
            <div class="card">
              <img src="images/pokeapi.png" class="card-img-top p-3" alt="...">
              <div class="card-body">
                <h5 class="card-title">Pokemon name</h5>
                <p class="card-text text-muted">
                  Info
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
