@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<?php 
print Former::horizontal_open()
  ->id('MyForm')
  ->secure()
  ->rules(array( 'name' => 'required' ))
  ->method('GET');
?>

<div class="row">
  <div class="six columns">
    <?php
    print Former::xlarge_text('name')
        ->class('myclass')
        ->value('Joseph')
        ->required();

    print Former::textarea('comments')
        ->rows(10)->columns(20)
        ->autofocus();

    print Former::actions (
        Former::large_primary_submit('Submit'),
        Former::large_inverse_reset('Reset')
      );
    ?>
  </div>
  <div class="six columns">
    <?php
    print Former::xlarge_text('name')
        ->class('myclass')
        ->value('Joseph')
        ->required();

    print Former::textarea('comments')
        ->rows(10)->columns(20)
        ->autofocus();

    print Former::actions (
        Former::large_primary_submit('Submit'),
        Former::large_inverse_reset('Reset')
      );
    ?>
  </div>
</div>

<?php
print Former::close();

?>

@endsection