<footer class="c-article__footer u-padding--left">
  @if (comments_open())
    <a class="c-social-tools__comment can-be--white o-kicker u-theme--color--base u-space--right js-toggle" data-prefix="this" data-toggled="c-comments"><span class="u-icon u-icon--xs u-theme--path-fill--base u-space--quarter--right">@include('patterns.00-atoms.icons.icon-contact')</span>Comment</a>
  @endif
  @include('patterns.01-molecules.components.share-tools')
</footer> <!-- /.c-article__footer -->
@include('patterns.02-organisms.sections.comments')
