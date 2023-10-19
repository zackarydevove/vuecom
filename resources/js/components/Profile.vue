<template>
	<div class="first-page-login">
		<div class="left-history">
			<h2>Purchase history</h2>
			<ul vfor="(item, index) in purchaseHistory">
				<li v-for="(item, index) in purchaseHistory" :key="index">
					<div class="item-name">{{ item.name }}</div>
					<div class="item-price">${{ item.price.toFixed(2) }}</div>
					<div class="item-date">{{ item.date }}</div>
				</li>
			</ul>

		</div>
		<div class="right-form">

			<a href="/"><button class="back-button">&#60;</button></a>

			<h1> Profile details </h1>
			<form @submit.prevent="changePassword">
				<label>E-mail</label>
				<input :value="user ? user.email : ''" readonly>

				<h1> Udate password </h1>

				<label>Current Password</label>
				<input placeholder="Current Password" type="password" v-model="password">

				<label>New Password</label>
				<input placeholder="New Password" type="password" v-model="newPassword">

				<label>Confirm New Password</label>
				<input placeholder="Confirm New Password" type="password" v-model="confirmNewPassword">

				<button type="submit" class="submit-btn">Submit</button>
			</form>
			<button class="logout-btn" @click="logout">Logout</button>
			<button class="logout-btn" @click="deleteAccount">Delete account</button>
		</div>

	</div>
</template>

<script lang="ts">
import axios from 'axios';
import { onMounted, ref } from 'vue';

interface User {
    email: string;
}

export default {
	data() {
		return {
			purchaseHistory: [
				{name: "Product A", price: 49.99, date: "2023-01-12"},
				{name: "Product B", price: 29.99, date: "2023-01-10"},
				{name: "Product C", price: 59.99, date: "2023-01-05"},
			],
			password: '',
			newPassword: '',
			confirmNewPassword: '',
		};
	},
	methods: {
		async logout() {
			try {
				if (localStorage.getItem('authToken')) {
					const response = await axios.post("http://127.0.0.1:8000/api/logout", {}, {
						headers: {
							'Authorization': `Bearer ${localStorage.getItem('authToken')}`
						}
					});
					console.log(response);
					localStorage.removeItem('authToken');
					this.$router.push('/');
				}
			} catch (error) {
				console.error(error);
			}
		},
		async deleteAccount() {
			if (localStorage.getItem('authToken'))
			{
				try {
					const response = await axios.delete('http://127.0.0.1:8000/api/user', {
						headers: {
							'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
							'Accept': 'application/json',
						}
					});
					
					console.log(response.data.message);
					localStorage.removeItem('authToken');
					this.$router.push('/');
				} catch (error) {
					console.error(error);
				}
			}
		},
		async changePassword() {
			if (this.confirmNewPassword !== this.newPassword)
			{
				console.log("New passwords doesn't match");
				return ;
			}
			if (!localStorage.getItem('authToken')) 
			{
				this.$router.push('/');
			}
			try {
				const response = await axios.post('http://127.0.0.1:8000/api/changepassword', {
					current_password: this.password,
					new_password: this.newPassword,
				}, {
					headers: {
						'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
						'Accept': 'application/json',
					}
				});
				
				console.log(response.data.message);
				localStorage.removeItem('authToken');
				this.$router.push('/');
			} catch (error) {
				console.error(error);
			}

		}
	},
	setup() {
		const user = ref<User | null>(null);
		// const purchaseHistory = ref([
		// {name: "Product A", price: 49.99, date: "2023-01-12"},
		// 	// other products...
		// ]);

		const fetchUser = async () => {
			try {
				const response = await axios.get('http://127.0.0.1:8000/api/user', {
					headers: {
						'Authorization': `Bearer ${localStorage.getItem('authToken')}`
					}
				});
				user.value = response.data;
			} catch (error) {
				console.error(error);
			}
		};

		onMounted(() => {
			fetchUser();
		});

		return {
			user,
			// purchaseHistory,
		}
	},
};
</script>

<style lang="scss">
$font-primary: "Helvetica Neue", Helvetica, Arial, sans-serif;
$font-color: #333;
$white-color: white;
$primary-color: #007BFF;
$hover-color: #0056b3;
$border-color: #ccc;
$transition-speed: 0.3s;

@mixin btn-style {
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

.first-page-login {
  display: flex;
  height: 100vh;
  font-family: $font-primary;

  .left-history {
	width: 70%;
	padding: 30px;
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 20px;
	background-color: #f5f5f5;

	h2 {
		color: $primary-color;
		font-size: 24px;
		margin-bottom: 20px;
	}

	ul {
		list-style: none;
		width: 100%;

		li {
			display: flex;
			justify-content: space-between;
			padding: 10px;
			border: 1px solid $border-color;
			border-radius: 5px;
			margin-bottom: 10px;

			.item-name, .item-price, .item-date {
				flex: 1;
				text-align: center;
			}
		}
	}
}

  .right-form {
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
		@include btn-style
	  }
	}

	.logout-btn {
		@include btn-style;
		margin-top: 15px;
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