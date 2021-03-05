<link rel="stylesheet" href="{public_url()}slide/css/style.css">;
<div class="carousel-section">
      <ul class="carousel my-carousel carousel--thumb">
        <input class="carousel__thumb" type="radio" id="1" name="thumb" checked="checked" />
        <input class="carousel__thumb" type="radio" id="2" name="thumb" />
        <input class="carousel__thumb" type="radio" id="3" name="thumb" />
        <input class="carousel__thumb" type="radio" id="4" name="thumb" />
        <input class="carousel__thumb" type="radio" id="5" name="thumb" />
        <div class="carousel__controls">
          <div class="back-btn">
            <label id="clickButton"
              class="carousel__control carousel__control--backward"
              for="5"
            ></label>
          </div>
          <div class="for-btn">
            <label
              class="carousel__control carousel__control--forward"
              for="2"
            ></label>
          </div>
        </div>
        <div class="carousel__controls">
          <div class="back-btn">
            <label id="clickButton"
              class="carousel__control carousel__control--backward"
              for="1"
            ></label>
          </div>
          <div class="for-btn">
            <label
              class="carousel__control carousel__control--forward"
              for="3"
            ></label>
          </div>
        </div>
        <div class="carousel__controls">
          <div class="back-btn">
            <label id="clickButton"
              class="carousel__control carousel__control--backward"
              for="2"
            ></label>
          </div>
          <div class="for-btn">
            <label
              class="carousel__control carousel__control--forward"
              for="4"
            ></label>
          </div>
        </div>
        <div class="carousel__controls">
          <div class="back-btn">
            <label id="clickButton"
              class="carousel__control carousel__control--backward"
              for="3"
            ></label>
          </div>
          <div class="for-btn">
            <label
              class="carousel__control carousel__control--forward"
              for="5"
            ></label>
          </div>
        </div>
        <div class="carousel__controls">
          <div class="back-btn">
            <label id="clickButton"
              class="carousel__control carousel__control--backward"
              for="4"
            ></label>
          </div>
          <div class="for-btn">
            <label
              class="carousel__control carousel__control--forward"
              for="1"
            ></label>
          </div>
        </div>
        
        
        <div class="carousel__track">
        {foreach $carousel as $r}
          <li class="carousel__slide">
          <img src="{base_url('upload/slide/')}{$r.sLink}" alt="">
          </li>
        {/foreach}
        </div>
        
        <!-- <div class="carousel__indicators">
          <label class="carousel__indicator" for="1">
          </label>
          <label class="carousel__indicator" for="2"></label>
          <label class="carousel__indicator" for="3"></label>
          <label class="carousel__indicator" for="4"></label>
          <label class="carousel__indicator" for="5"></label>
        </div> -->
      </ul>
    </div>
