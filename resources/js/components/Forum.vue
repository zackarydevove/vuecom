<template>
	<div class="blog-first-page">
	  <navbar color="black" />
	  <div class="content-container">
		<div class="up-div">
		  <div class="search-bar">
			<input type="text" v-model="searchTerm" placeholder="Search..." />
		  </div>
		</div>
		<div class="down-div">
		  <div class="categories">
			<p @click="createPost">Create a post</p>
			<p v-for="category in categories" :key="category" @click="filterByCategory(category)">
			  {{ category }}
			</p>
		  </div>
		  <div class="post-list">
			<div class="post-content" v-for="(post, index) in filteredPosts" :key="index">
			  <div class="post-category">{{ post.category }}</div>
			  <h1 class="post-title">{{ post.title }}</h1>
			  <button class="post-btn" @click="readMore(post)">Read more</button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </template>
  
  <script lang="ts">
  import Vue from 'vue';
  export default {
	data() {
	  return {
		searchTerm: '',
		posts: [
		  { category: 'Gym', title: 'Best practices for a great workout' },
		  { category: 'Food', title: 'Healthy eating for an active lifestyle' },
		  { category: 'MMA', title: 'Top 10 MMA training techniques' },
		  // Add more posts here
		],
		categories: ['Gym', 'Food', 'MMA', 'Boxing', 'Cross-fit'], // Add more categories here
	  };
	},
	computed: {
	  filteredPosts() {
		if (!this.searchTerm) {
		  return this.posts;
		}
		const lowerCasedTerm = this.searchTerm.toLowerCase();
		return this.posts.filter((post) => post.title.toLowerCase().includes(lowerCasedTerm));
	  },
	},
	methods: {
	  createPost() {
	  },
	  readMore(post: any) {
		console.log(post);
	  },
	  filterByCategory(category: any) {
		console.log(category);
	  },
	},
  };
  </script>
  
  <style scoped lang="scss">
  .blog-first-page {
	display: flex;
	flex-direction: column;
	height: 100vh;
	padding: 20px;
	background-color: #f5f5f5; // light grey background
  
	.content-container {
	  flex-grow: 1;
	  display: flex;
	  flex-direction: column;
	  gap: 20px;
  
	  .up-div {
		.search-bar {
		  display: flex;
		  justify-content: center;
  
		  input {
			padding: 10px;
			width: 100%;
			max-width: 400px;
			border-radius: 20px;
			border: 1px solid #ccc;
			outline: none;
		  }
		}
	  }
  
	  .down-div {
		flex-grow: 1;
		display: flex;
		gap: 20px;
  
		.categories {
		  min-width: 200px;
  
		  p {
			cursor: pointer;
			margin-bottom: 5px;
			&:hover {
			  text-decoration: underline;
			}
		  }
		}
  
		.post-list {
		  flex-grow: 1;
		  display: grid;
		  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
		  gap: 20px;
  
		  .post-content {
			background: white;
			border-radius: 10px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
			padding: 20px;
			display: flex;
			flex-direction: column;
			gap: 10px;
  
			.post-category {
			  background: orange;
			  color: white;
			  border-radius: 15px;
			  padding: 5px 10px;
			  display: inline-block;
			  text-transform: uppercase;
			  font-size: 0.8em;
			}
  
			.post-title {
			  margin: 0;
			  font-size: 1.2em;
			  flex-grow: 1;
			}
  
			.post-btn {
			  padding: 10px;
			  background: darkorange;
			  color: white;
			  border: none;
			  border-radius: 15px;
			  cursor: pointer;
			  text-transform: uppercase;
			  font-weight: bold;
  
			  &:hover {
				background: orange;
			  }
			}
		  }
		}
	  }
	}
  }
  </style>
  