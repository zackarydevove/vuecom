<template>
	<div class="first-page-login">
		<div class="left-form">

			<a href="/"><button class="back-button">&#60;</button></a>

			<h1> Sign up </h1>
			<form @submit.prevent="signup">
				<label>E-mail</label>
				<input placeholder="E-mail" v-model="email" type="email">

				<label>Password</label>
				<input placeholder="Password" v-model="password" type="password">

				<label>Confirm Password</label>
				<input placeholder="Confirm Password" v-model="confirm_password" type="password">

				<button type="submit">Submit</button>
			</form>
			<hr />
			<div>
				<a href="/login">Already have an account ?</a>
				<a>Password forgot ?</a>
			</div>

		</div>
		<div class="right-img">
			
		</div>
	</div>
</template>

<script lang="ts">
import axios from 'axios';
export default {
	data() {
		return {
			email: '',
			password: '',
			confirm_password: '',
		}
	},
	methods: {
		async signup() {
			if (this.password === this.confirm_password)
			{
				try {
					const response = await axios.post('http://127.0.0.1:8000/api/register', {
						email: this.email,
						password: this.password,
					});

					if (response.data.authorisation) {
						localStorage.setItem('authToken', response.data.authorisation.token);
					}
					
					console.log(response.data.message);
				} catch (err: any) {
					console.log(err.response.data);
				}
			} else {
				console.log("Passwords do not match");
			}
		}
	}
}
</script>

<style lang="scss">
$font-primary: "Helvetica Neue", Helvetica, Arial, sans-serif;
$font-color: #333;
$white-color: white;
$primary-color: #007BFF;
$hover-color: #0056b3;
$border-color: #ccc;
$transition-speed: 0.3s;

.first-page-login {
  display: flex;
  height: 100vh;
  font-family: $font-primary;

  .right-img {
	background-image: url('/marble_dumbell4.jpeg');
	background-size: cover;
	background-position: center;
	width: 70%;
  }

  .left-form {
	position: relative;
	width: 30%;
	display: flex;
	flex-direction: column;
	justify-content: center;
	padding: 50px;

	.back-button {
		position: absolute;
		left: 10px;
		top: 10px;
		border-radius: 50%;
		width: 30px;
		height: 30px;
		background-color: black;
		color: white;
		border: 0;

		&:hover {
			background-color: white;
			color: black;
			border: 1px solid black;
			cursor: pointer;
		}
	}

	h1 {
	  font-size: 32px;
	  margin-bottom: 30px;
	  text-align: center;
	  color: $font-color;
	}

	form {
	  display: flex;
	  flex-direction: column;
	  gap: 20px;

	  label {
		font-size: 16px;
		color: $font-color;
		margin-bottom: 10px;
	  }

	  input {
		padding: 15px;
		border: 1px solid $border-color;
		border-radius: 5px;
		font-size: 16px;

		&:focus {
		  border-color: $primary-color;
		  box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.2);
		}
	  }

	  button {
		padding: 15px;
		background-color: $primary-color;
		border: none;
		color: $white-color;
		border-radius: 5px;
		cursor: pointer;
		transition: background-color $transition-speed;

		&:hover {
		  background-color: $hover-color;
		}
	  }
	}

	hr {
	  margin: 20px 0;
	  border: 0.5px solid $border-color;
	}

	div {
	  display: flex;
	  justify-content: space-between;

	  a {
		text-decoration: none;
		color: $primary-color;
		font-size: 14px;
		transition: color $transition-speed;

		&:hover {
		  color: $hover-color;
		}
	  }
	}
  }
}
</style>