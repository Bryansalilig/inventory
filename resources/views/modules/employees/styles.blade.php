@push('styles')
  <style>
    .asset-container h5 {
      margin-bottom: 10px;
      font-size: 1.2rem;
    }

    .asset-card {
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s;
      cursor: pointer;
    }

    .asset-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .asset-card h6 {
      font-size: 0.9rem;
      margin-bottom: 5px;
    }

    .asset-card span {
      font-size: 0.8rem;
      color: #555;
    }

    .select2-container--default .select2-results__option {
      font-size: 14px;
      padding: 5px 5px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      font-size: 14px;
      line-height: 2.2rem;
    }

    .select2-container--default .select2-selection--single {
      height: 35px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 35px;
    }

    /* Ensure modal is above everything */
    .modal {
      z-index: 2000 !important;
    }

    /* Ensure backdrop is just below modal */
    .modal-backdrop {
      z-index: 1999 !important;
    }

    /* Max height for mobile screens */
    @media (max-width: 767px) {
      .modal-dialog {
        max-height: 90vh; /* modal never exceeds viewport height */
        margin: 0.5rem auto;
      }

      .modal-content {
        overflow-y: auto; /* scroll if content is too tall */
      }
    }

    .asset-card--empty {
      cursor: not-allowed;
    }
  </style>
@endpush
