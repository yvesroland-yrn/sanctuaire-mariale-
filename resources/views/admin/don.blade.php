@extends('admin.layouts.app')

@section('title', 'Les Dons')
@section('page-title', 'Les Dons')
@section('page-subtitle', 'Suivi des dons et contributions')

@push('styles')
<style>
  .admin-placeholder-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 24px;
  }

  .admin-placeholder-card {
    background: #fff;
    border: 1px solid rgba(148, 163, 184, 0.14);
    border-radius: 22px;
    padding: 22px;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.05);
  }

  .admin-placeholder-card .label {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #64748b;
    margin-bottom: 8px;
  }

  .admin-placeholder-card .value {
    font-size: 1.9rem;
    font-weight: 800;
    color: #0f172a;
  }

  .admin-panel {
    background: #fff;
    border: 1px solid rgba(148, 163, 184, 0.14);
    border-radius: 26px;
    padding: 28px;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.05);
  }

  .admin-empty {
    text-align: center;
    padding: 36px 18px;
    color: #64748b;
  }

  @media (max-width: 900px) {
    .admin-placeholder-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endpush

@section('content')
  <div class="admin-placeholder-grid">
    <div class="admin-placeholder-card">
      <div class="label">Total des dons</div>
      <div class="value">0</div>
    </div>
    <div class="admin-placeholder-card">
      <div class="label">Dons validés</div>
      <div class="value">0</div>
    </div>
    <div class="admin-placeholder-card">
      <div class="label">En attente</div>
      <div class="value">0</div>
    </div>
  </div>

  <section class="admin-panel">
    <h2 style="font-size:1.05rem;font-weight:800;margin-bottom:10px;">Gestion des dons</h2>
    <p style="color:#64748b;margin-bottom:0;">
      Cette section est prête pour afficher les contributions dès que la source de données sera connectée.
    </p>
    <div class="admin-empty">
      Aucune donnée de don disponible pour le moment.
    </div>
  </section>
@endsection
