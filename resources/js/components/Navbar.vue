<template>
	<nav class="main-nav" :style="{ '--primary-color': color }">
		<div class="branding">
			<h1><a href="/" class="logo-link">VUECOM</a></h1>
		</div>
		<ul class="nav-list">
			<li><a href="/" class="nav-link">HOME</a></li>
			<li><a href="/product" class="nav-link">PRODUCT</a></li>
		</ul>
		<div class="auth-actions">
			<a href="/login" class="login-btn">LOGIN</a>
		</div>
	</nav>
</template>

<script lang="ts">
export default {
	name: 'navbar',
	props: {
		color: {
			type: String,
			default: 'white'
		}
	}
}
</script>

<style lang="scss">
$primary-font: "Clarkson",Helvetica,sans-serif;
$primary-color: var(--primary-color);
$transition-speed: 0.3s ease;

@mixin link-styles {
    color: $primary-color;
    text-decoration: none;
    transition: $transition-speed;

    &:hover {
        text-decoration: underline;
    }
}

.main-nav {
    font-family: $primary-font;
    font-size: 16px;
    color: $primary-color;
    padding: 25px 40px;

    display: flex;
    flex-direction: row;
    justify-content: space-between;
	align-items: center;

	.branding {
        .logo-link {
            color: $primary-color;
            text-decoration: none;
        }
    }

    .nav-list {
        list-style-type: none;
        display: flex;
        flex-direction: row;
        gap: 30px;

        .nav-link {
            @include link-styles;
        }
    }

    .auth-actions {
        .login-btn {
            @include link-styles;
        }
    }
}
</style>
