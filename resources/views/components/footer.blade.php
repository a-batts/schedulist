<foooter class="app-footer mdc-typography mt-12" style="z-index: 9" id="footer">
  <div class="footer-div w-full">
    <div class="float-right hidden md:block mr-12">
      <a rel="prefetch" href="{{ route('privacy-policy') }}">
        <button class="mdc-button">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">Privacy Policy</span>
        </button>
      </a>
      <br />
      <a rel="prefetch" href="{{ route('contact') }}">
        <button class="mdc-button text-right">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">Contact Us</span>
        </button>
      </a>
    </div>
    <div class="logoimage w-28 mt-7 ml-8 mb-1 h-10">
    </div>
    <p class="w-80 ml-8 mdc-typography--subtitle1 mt-2">
      Helpful organization for online classes
    </p>
    <div class="md:hidden md:mt-10 md:mr-16 ml-6 mt-5 pb-4">
      <a href="{{ route('privacy-policy') }}">
        <button class="mdc-button">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">Privacy Policy</span>
        </button>
      </a>
      <br / class="hidden md:block">
      <a href="{{ route('contact') }}">
        <button class="mdc-button text-right">
          <span class="mdc-button__ripple"></span>
          <span class="mdc-button__label">Contact Us</span>
        </button>
      </a>
    </div>
  </div>
</foooter>
