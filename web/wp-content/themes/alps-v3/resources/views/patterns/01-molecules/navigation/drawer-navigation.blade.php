<div class="c-drawer l-grid l-grid--7-col">
  <div class="c-drawer__toggle js-toggle-parent u-theme--background-color-trans--darker">
    <div class="u-icon o-icon__close">
      <span></span>
      <span></span>
    </div>
  </div> <!-- .c-drawer__toggle -->
  <div class="l-grid-wrap--6-of-7 l-grid-item--s--6-col c-drawer__container u-spacing u-theme--background-color--darker">
    <div class="c-drawer__search">
      @include('patterns.01-molecules.forms.search')
    </div> <!-- .c-drawer__search -->
    <div class="c-drawer__nav">
      <div class="c-drawer__nav-primary">
        @include('patterns.01-molecules.navigation.primary-navigation')
        <ul class="c-drawer__subnav u-theme--background-color--darker">
        </ul>
      </div>
      <div class="c-drawer__nav-secondary">
        @include('patterns.01-molecules.navigation.secondary-navigation')
      </div>
    </div> <!-- .c-drawer__nav -->
    <div class="c-drawer__logo">
      <span class="u-icon u-icon--l u-path-fill--white">
        @include('patterns.00-atoms.icons.icon-logo')
      </span>
    </div> <!-- .c-drawer__logo -->
    <div class="c-drawer__about">
      <div class="c-drawer__about-left u-spacing">
        <p>Tell the world is an offical media production of the Seventh-day Adventist world church.</p>
        <p>Seventh-day Adventists are devoted to helping people understand the Bible to find freedom, healing and hope.</p>
      </div>
      <div class="c-drawer__about-right u-spacing--half">
        <h3 class="u-font--secondary--s u-text-transform--upper"><strong>Learn More:</strong></h3>
        <p class="u-spacing--half">
          <a href="" target="_blank" class="u-link--white">Adventist.org</a>
          <a href="" target="_blank" class="u-link--white">North American Division of Seventh-day Adventists</a>
          <a href="" target="_blank" class="u-link--white">ADRA International</a>
        </p>
      </div>
    </div> <!-- .c-drawer__about -->
  </div> <!-- .c-drawer__container -->
</div> <!-- .c-drawer-->
