<template>
	<div class="product-first-page">
		<Navbar color="black"/>
		<div class="product-container">
			<div class="product-info">
				<div class="img-container">
					<div v-for="(img, index) in images" :key="index" 
						:class="['carousel-slide', { 'active': currentSlide === index }]">
						<img :src="img" class="product-img">
					</div>
					<div class="carousel-controls">
						<button @click="prevSlide">&#60;</button>
						<button @click="nextSlide">&#62;</button>
					</div>
				</div>
				<div class="description-container">
					<h1>MARBLE DUMBELL</h1>
					<p>$249</p>
					<div class="dumbell-weights">
						<p>10 kg</p>
						<p>20 kg</p>
						<p>30 kg</p>
					</div>


					<stripe-checkout
						ref="checkoutRef"
						:pk="publishableKey"
						:sessionId="sessionId"
					/>
					<div class="buy-button" @click="submit">BUY</div>
				</div>
			</div>
		</div>
	</div>
</template>
  
<script lang="ts">
import axios from 'axios';
import { StripeCheckout } from '@vue-stripe/vue-stripe';
export default {
	name: 'product',
	components: {
		StripeCheckout,
	},
	data() {
		return {
			publishableKey: 'pk_test_51O1pVyJfTkkiwhMIfyOBTAdpYsZrRZjvXcvH1J7YzM4yno9W8jj3dfsfjvAEdFQgPdXninIgZa2DWc6xNCyigz6W00aj72Kcel',
			sessionId: '',
			loading: false,
			lineItems: [
				{
					price: '249',
					quantity: 1,
				},
			],
			successURL: 'your-success-url',
			cancelURL: 'your-cancel-url',
			images: [
				'/marble_dumbell1.jpeg',
				'/marble_dumbell2.jpeg',
				'/marble_dumbell3.jpeg',
				'/marble_dumbell4.jpeg'
			],
			currentSlide: 0
		};
	},
	mounted() {
		this.getSession();
	},
	methods: {
		nextSlide() {
			if (this.currentSlide < this.images.length - 1) {
				this.currentSlide++;
			} else {
				this.currentSlide = 0;
			}
		},
		prevSlide() {
			if (this.currentSlide > 0) {
				this.currentSlide--;
			} else {
				this.currentSlide = this.images.length - 1;
			}
		},
		getSession() {
			axios.get('http://127.0.0.1:8000/api/get-checkout-session')
			.then(res => {
				if (res.data && res.data.id) {
					this.sessionId = res.data.id;
					console.log(res);
				} else {
					// Handle error response
					console.error('Error retrieving session:', res.data);
				}
			})
			.catch(err => console.log(err));
		},
		submit () {
			(this.$refs as any).checkoutRef.redirectToCheckout();
		},
	}
};
</script>
  
<style lang="scss">
$primary-font: "Clarkson", Helvetica, sans-serif;
$card-bg-color: #f5f5f5;
$product-image-bg-color: black;

.product-first-page {
  height: 100vh;
  width: 100vw;
  font-family: $primary-font;
  background-color: white;

  .product-container {
	height: calc(100vh - 120px);
	display: flex;
	justify-content: center;
	align-items: center;

	.product-info {
		width: 100vw;
		display: flex;
		justify-content: space-evenly;
		align-items: center;
		padding: 0px 50px;

		.img-container {
			position: relative;
			width: 700px;
			height: 700px;

			.carousel-slide {
				opacity: 0;
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				transition: opacity 0.5s;

				&.active {
					opacity: 1;
				}

				.product-img {
					width: 100%;
					height: 100%;
				}
			}

			.carousel-controls {
				position: absolute;
				top: 50%;
				transform: translateY(-50%);
				width: 100%;
				display: flex;
				justify-content: space-between;

				button {
					background-color: rgba(0, 0, 0, 0.6);
					color: white;
					padding: 5px 10px;
					border: none;
					cursor: pointer;

					&:hover {
						background-color: rgba(0, 0, 0, 0.8);
					}
				}
			}
		}

		.description-container {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 15px;

			.dumbell-weights {
				display: flex;
				gap: 5px;
			}

			.buy-button {
				padding: 20px 50px;
				background-color: black;
				color: white;

				&:hover {
					cursor: pointer;
					opacity: 80%;
				}
			}
		}
		
	}
  }
}
</style>
  