## The "So LIT" Stack

[Statamic](https://statamic.com/) is a great CMS, [Laravel](https://laravel.com/) is a great backend, [InertiaJS](https://inertiajs.com/) is the amazing bridge between Laravel and your [VueJS](https://vuejs.org/) frontend, and [TailwindCSS](https://tailwindcss.com/) is icing on the cake.

## About this Setup

**TL;DR:** Check out the following key files that make this setup work:

- https://github.com/truefrontier/so-lit-stack/blob/master/routes/web.php
- https://github.com/truefrontier/so-lit-stack/blob/master/app/Http/Controllers/PageController.php
- https://github.com/truefrontier/so-lit-stack/blob/master/resources/js/site.js

Statamic is basically the headless CMS in this setup. The main difference in your typical InertiaJS setup, is the nested layout fallback system. 

### Nested Layouts with Fallbacks

Statamic offers Layouts and Templates, and then it passes in the Page content. If the layout or template props are empty, they return `default`. Inertia renders a Page component and offers a persistent Layout setup if you want. To combine the two, we pull a StudlyCased version of the `layout`, `template`, and `slug` properties from your Statamic page and pass them to Inertia. Inertia looks for `Layouts/<your-layout-prop>.vue`,  `Templates/<your-template-prop>.vue`, and  `Pages/<your-slug-prop>.vue` and falls back to `Layouts/Default.vue`,  `Templates/Default.vue`, and  `Pages/Default.vue` respectively if not found. This gives you SO much flexibility in how you set up your website! You can have an `Admin` layout, a `Dashboard` template, and a `Reports` page or a `Blog` template and `Default` page. 

### Statamic Content as Component Props
All of Statamic's augmented page data is sent through InertiaJS to you page component as a `cms` prop. So `<div v-html="cms.content"></div>` will give you Statamic's HTML content! It's amazing.

### The Good Ol' Ways
If there are any pages you don't want to come from Statamic, you still can explicitly do some select routes the Laravel way or the InertiaJS way.


## Roadmap
**This is working, but there's more to do!**

1. Get [Ziggy](https://github.com/tightenco/ziggy) to get all of Statamic's urls so you can use the `<inertia-link>` component


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
