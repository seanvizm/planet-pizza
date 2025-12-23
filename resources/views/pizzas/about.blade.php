@extends('layouts.app')

@section('content')

    <section class="my-10 p-10 about-section">
        <div style="max-width: 800px; padding: 28px; margin: 0 auto; text-align: center;">
            <h2 class="about-title">About</h2>
            <p class="about-text" style="margin-top: 20px; line-height: 1.8;">Handcrafted with passion, baked to perfection! At PizzaPlanet, we use only the finest ingredients to create mouthwatering pizzas that'll transport your taste buds to heaven. From our signature classics to custom creations with your favorite toppings - every slice tells a delicious story. Order now and taste the difference!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipiscing elit. Quisque faucibus ex sapien vitae pellentesque sem placerat. In id cursus mi pretium tellus duis convallis. Tempus leo eu aenean sed diam urna tempor. Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere. Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.</p>
        </div>
    </section>

    <style>
        /* About section theme styles */
        .about-section {
            background-color: #1a1d21;
            transition: background-color 0.3s ease;
        }

        [data-theme="light"] .about-section {
            background-color: #ffffff;
        }

        .about-title {
            color: #f4c430;
            font-size: 2.5rem;
            font-weight: 700;
        }

        [data-theme="light"] .about-title {
            color: #212529;
        }

        .about-text {
            color: #e0e0e0;
        }

        [data-theme="light"] .about-text {
            color: #495057;
        }
    </style>

@endsection
