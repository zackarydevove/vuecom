<template>
	<div class="home-first-page">
		<Navbar />

		<div class="home-content">
			<div class="home-content-div">
				<h1>Designed to Sell</h1>
				<div class="call-to-action">
					<button>GET STARTED</button>
					<p>Get your free website trial today. <br/> No credit card required.</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script lang="ts">
export default {
	name: 'home'
}
</script>

<style lang="scss">
$primary-font: "Clarkson", Helvetica, sans-serif;
$primary-color: white;
$transition-speed: 0.3s ease;
$secondary-color: rgb(202, 196, 196);
$button-padding: 17px 25px;

.home-first-page {
  background-image: url('/homeScreen.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100vh;
  width: 100vw;
  font-family: $primary-font;

  .home-content {
    height: 80%;
    display: flex;
    align-items: center;
    color: $primary-color;
    font-size: 25px;
    margin-left: 3.5em;

    .home-content-div {
      display: flex;
      flex-direction: column;
      gap: 20px;

      h1 {
        font-size: 100px;
      }

      .call-to-action {
        display: flex;
        align-items: center;
        gap: 30px;

        button {
          padding: $button-padding;
          font-weight: 700;
          transition: opacity $transition-speed;

          &:hover {
            opacity: 70%;
            cursor: pointer;
          }
        }

        p {
          color: $secondary-color;
          font-size: 18px;
        }
      }
    }
  }
}
</style>