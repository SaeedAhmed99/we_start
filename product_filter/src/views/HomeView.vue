<template>
  <main>
      <section class="hero">
        <h1>Welcome Everyone in Home Page</h1>
        <img src="@/assets/slider.jpg" alt="">
      </section>
  </main>
</template>

<script>
</script>

<style scoped>
.hero {
  position: absolute;
  width: 100%;
}

.hero::before {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-color: rgba(0,0,0,0.3);
}

.hero h1 {
  color: white;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  margin: 0;
  font-size: 36px;
  z-index: 5;
}
.hero img {
  height: 500px;
  width: 100%;
  object-fit: cover;
  display: block;
}


</style>