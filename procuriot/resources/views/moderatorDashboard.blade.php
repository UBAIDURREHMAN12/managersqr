@include('components.head')

<style>
    .filter-option {
        display: none;
    }
    .bs-caret {
        display: none;
    }
    .caret {
        display: none;
    }
    .dropdown-toggle {
        display: none;
    }
</style>
@include('components.navbar')
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
@include('components.sidebar')
<!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
@include('components.rightsidebar')
<!-- #END# Right Sidebar -->
</section>

<p>this is moderator dashboard</p>



@include('components.footer')


