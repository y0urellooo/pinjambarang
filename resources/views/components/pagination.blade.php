<!-- pagination -->

@if ($paginator->hasPages())
<div class="d-flex justify-content-end mt-3 me-4">
    {{ $paginator->links() }}
</div>
@endif
