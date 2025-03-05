<!DOCTYPE html>
<html>
<head>
  <title>Corrective Lenses</title>
  <style>
    body {
      font-family: sans-serif;
	  background-color: aquamarine;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .product {
      display: flex;
      width: 700px;
      padding: 100px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .image {
      width: 300px;
      margin-right: 30px;
    }

    .details {
      width: 370px;
    }

    .title {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .description {
      font-size: 16px;
      line-height: 1.5;
      margin-bottom: 20px;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .options label {
      font-weight: bold;
      margin-right: 10px;
    }

    .options input[type="radio"] {
      margin-right: 5px;
    }

    .options .color-options {
      display: flex;
    }

    .options .color-option {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
      cursor: pointer;
    }

    .options .color-option.red {
      background-color: red;
    }

    .options .color-option.blue {
      background-color: blue;
    }

 .options .color-option.green {
      background-color: green;
    }

    .buy-button {
      padding: 10px 20px;
      background-color: #f44336;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .buy-button:hover {
      background-color: #d32f2f;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        height: auto;
      }

      .product {
        flex-direction: column;
        width: 90%;
      }

      .image {
        width: 100%;
        margin-right: 0;
      }

      .details {
        width: 100%;
      }

      .title {
        font-size: 28px;
      }

      .description {
        font-size: 14px;
      }

      .buy-button {
        font-size: 14px;
      }
    }
	.checked {
     color: orange;
}
  </style>
</head>
<a href="service.php"class="buy-button">back</button></a>
<body>
  <div class="container">
    <div class="product">
      <div class="image">
        <img src="img/Contact Lenses.jpg" alt="Beats EP Headphones" style="width: 100%; border-radius: 0px;">
      </div>
      <div class="details">
        <h1 class="title">Contact Lenses</h1>
        <p class="description">Contact lenses are thin lenses that sit on top of the cornea (the clear outer layer of the eye). They correct refractive errors to make your vision clearer — just like eyeglasses. About 45 million Americans wear contact lenses. If you use them the right way, they can be a safe and effective alternative to eyeglasses</p>
        <div class="options">
          <label for="color">Rating</label>
          <div class="color-white">
		  <h2></h2>
        <span class="fa fa-star checked"> ★</span> 
        <span class="fa fa-star checked"> ★</span>
        <span class="fa fa-star checked"> ★</span>
        <span class="fa fa-star">★</span>
       <span class="fa fa-star">★</span>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</body>
</html>