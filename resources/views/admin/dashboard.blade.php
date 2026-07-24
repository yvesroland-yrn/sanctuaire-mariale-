@extends('admin.layouts.app')

@section('title', 'Tableau de Bord')
@section('page-title', 'Tableau de Bord')

@push('styles')
<style>
  .dashboard-header {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 28px;
  }

  .dashboard-card {
    background: rgba(255, 255, 255, 0.92);
    border: 1px solid rgba(148, 163, 184, 0.18);
    border-radius: 28px;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.06);
    padding: 24px 26px;
    min-height: 130px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 18px;
  }

  .dashboard-card:first-child { border-left: 4px solid #2563eb; }
  .dashboard-card:nth-child(2) { border-left: 4px solid #14b8a6; }
  .dashboard-card:nth-child(3) { border-left: 4px solid #f59e0b; }
  .dashboard-card:nth-child(4) { border-left: 4px solid #8b5cf6; }

  .dashboard-card .card-label {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #64748b;
    margin-bottom: 10px;
  }

  .dashboard-card .card-value {
    font-size: 2.2rem;
    font-weight: 800;
    color: #0f172a;
  }

  .dashboard-card .card-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #2563eb;
    font-weight: 700;
    text-decoration: none;
  }

  .dashboard-layout {
    display: grid;
    grid-template-columns: 2.4fr 1fr;
    gap: 24px;
  }

  .dashboard-panel {
    background: rgba(255, 255, 255, 0.96);
    border: 1px solid rgba(148, 163, 184, 0.14);
    border-radius: 30px;
    box-shadow: 0 24px 60px rgba(15, 23, 42, 0.06);
    padding: 28px;
  }

  .panel-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 22px;
  }

  .panel-title h2 {
    font-size: 1.05rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
  }

  .panel-title .btn-primary {
    padding: 12px 18px;
    border-radius: 999px;
    font-size: 0.9rem;
  }

  .summary-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin-bottom: 24px;
  }

  .summary-card {
    background: #f8fafc;
    border-radius: 22px;
    padding: 18px 20px;
    border: 1px solid rgba(148, 163, 184, 0.12);
  }

  .summary-title {
    font-size: 0.82rem;
    color: #64748b;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 0.12em;
  }

  .summary-value {
    font-size: 1.65rem;
    font-weight: 800;
    color: #0f172a;
  }

  .summary-note {
    margin-top: 12px;
    color: #475569;
    font-size: 0.9rem;
  }

  .table-wrapper {
    overflow-x: auto;
  }

  .admin-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 720px;
  }

  .admin-table th,
  .admin-table td {
    padding: 18px 16px;
    text-align: left;
    border-bottom: 1px solid rgba(148, 163, 184, 0.1);
  }

  .admin-table th {
    color: #475569;
    font-size: 0.82rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    background: rgba(248, 250, 252, 0.95);
    border-bottom: 2px solid rgba(148, 163, 184, 0.15);
  }

  .admin-table td {
    color: #334155;
    font-size: 0.95rem;
  }

  .admin-table tbody tr:hover {
    background: rgba(37, 99, 235, 0.06);
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 14px;
    background: #e2e8f0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #0f172a;
    font-weight: 800;
    margin-right: 14px;
  }

  .user-name {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-weight: 700;
    color: #0f172a;
  }

  .user-email {
    display: block;
    color: #64748b;
    font-size: 0.88rem;
  }

  .tag {
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 700;
    color: #0f172a;
    background: #f1f5f9;
  }

  .tag.admin { background: #dbeafe; color: #1d4ed8; }
  .tag.editor { background: #ddf6e4; color: #166534; }
  .tag.viewer { background: #fef3c7; color: #92400e; }

  .status-dot {
    width: 10px;
    height: 10px;
    border-radius: 999px;
    display: inline-block;
    margin-right: 8px;
  }

  .status-active { background: #34d399; }
  .status-idle { background: #facc15; }
  .status-offline { background: #f87171; }

  .activity-card {
    display: grid;
    grid-template-columns: 1fr;
    gap: 18px;
  }

  .activity-item {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    padding: 18px 20px;
    background: #f8fafc;
    border-radius: 22px;
    border: 1px solid rgba(148, 163, 184, 0.12);
  }

  .activity-info {
    display: flex;
    gap: 14px;
    align-items: center;
  }

  .activity-icon {
    width: 44px;
    height: 44px;
    border-radius: 16px;
    display: grid;
    place-items: center;
    color: white;
    font-size: 1rem;
  }

  .activity-icon.news { background: #2563eb; }
  .activity-icon.project { background: #14b8a6; }
  .activity-icon.message { background: #8b5cf6; }
  .activity-icon.user { background: #f59e0b; }

  .activity-meta {
    color: #334155;
  }

  .activity-meta strong {
    display: block;
    margin-bottom: 4px;
    font-weight: 700;
  }

  .activity-time {
    color: #64748b;
    font-size: 0.85rem;
  }

  @media (max-width: 1100px) {
    .dashboard-header {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .dashboard-layout {
      grid-template-columns: 1fr;
    }
  }

  @media (max-width: 720px) {
    .dashboard-card,
    .dashboard-panel,
    .activity-item {
      padding: 20px;
    }

    .dashboard-header {
      grid-template-columns: 1fr;
    }

    .summary-grid {
      grid-template-columns: 1fr;
    }
  }
</style>
@endpush

@section('content')

<div class="dashboard-header">
  <div class="dashboard-card">
    <div>
      <div class="card-label">Actualités publiées</div>
      <div class="card-value">{{ $totalActualites }}</div>
    </div>
    <div><i class="fas fa-newspaper fa-lg"></i></div>
  </div>

  <div class="dashboard-card">
    <div>
      <div class="card-label">Utilisateurs</div>
      <div class="card-value">{{ $totalUtilisateurs }}</div>
    </div>
    <div><i class="fas fa-users fa-lg"></i></div>
  </div>
  <div class="dashboard-card">
    <div>
      <div class="card-label">Messages reçus</div>
      <div class="card-value">{{ $totalMessages }}</div>
    </div>
    <div><i class="fas fa-envelope fa-lg"></i></div>
  </div>
   <div class="dashboard-card">
    <div>
      <div class="card-label">Don reçus</div>
      <div class="card-value">{{ $totalMessages }}</div>
    </div>
    <div><i class="fas fa-envelope fa-lg"></i></div>
  </div>
   <div class="dashboard-card">
    <div>
      <div class="card-label">Reservation reçus</div>
      <div class="card-value">{{ $totalMessages }}</div>
    </div>
    <div><i class="fas fa-envelope fa-lg"></i></div>
  </div>
</div>

<div class="dashboard-layout">
  <section class="dashboard-panel">
    <div class="panel-title">
      <h2>Liste des utilisateurs</h2>
      <a href="{{ route('admin.utilisateurs') }}" class="btn btn-primary">Voir tous</a>
    </div>

    <div class="summary-grid">
      <div class="summary-card">
        <div class="summary-title">Total membres</div>
        <div class="summary-value">{{ $totalUtilisateurs }}</div>
        <div class="summary-note">{{ $totalActifs }} actifs • {{ $totalInactifs }} inactifs</div>
      </div>
      <div class="summary-card">
        <div class="summary-title">Admins actifs</div>
        <div class="summary-value">{{ $totalAdmins }}</div>
        <div class="summary-note">{{ $totalStatistiques }} entrées de statistiques</div>
      </div>
      <div class="summary-card">
        <div class="summary-title">Visites enregistrées</div>
        <div class="summary-value">{{ $visites }}</div>
        <div class="summary-note">À partir des statistiques du tableau de bord</div>
      </div>
    </div>

    <div class="table-wrapper">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Utilisateur</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Status</th>
            <th>Dernière activité</th>
          </tr>
        </thead>
        <tbody>
          @forelse($derniersUtilisateurs as $utilisateur)
          <tr>
            <td>
              <span class="user-name">
                <span class="user-avatar">{{ $utilisateur->initials }}</span>
                {{ $utilisateur->full_name }}
              </span>
              <span class="user-email">{{ $utilisateur->email }}</span>
            </td>
            <td>{{ $utilisateur->email }}</td>
            <td><span class="tag {{ $utilisateur->role === 'admin' ? 'admin' : ($utilisateur->role === 'moderateur' ? 'editor' : 'viewer') }}">{{ ucfirst($utilisateur->role) }}</span></td>
            <td><span class="tag">{{ $utilisateur->statut ?? 'actif' }}</span></td>
            <td>{{ $utilisateur->created_at?->diffForHumans() ?? '—' }}</td>
          </tr>
          @empty
          <tr><td colspan="5" style="text-align:center;">Aucun utilisateur enregistré.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <aside class="dashboard-panel">
    <div class="panel-title">
      <h2>Activité récente</h2>
      <a href="{{ route('admin.messages') }}" class="btn btn-secondary">Voir plus</a>
    </div>

    <div class="activity-card">
      @forelse($derniersMessages as $message)
      <div class="activity-item">
        <div class="activity-info">
          <span class="activity-icon message"><i class="fas fa-envelope"></i></span>
          <div class="activity-meta">
            <strong>Message reçu</strong>
            <span>{{ Str::limit($message->objet, 45) }}</span>
          </div>
        </div>
        <span class="activity-time">{{ $message->created_at?->diffForHumans() }}</span>
      </div>
      @empty
      <div class="activity-item">
        <div class="activity-info">
          <span class="activity-icon message"><i class="fas fa-envelope"></i></span>
          <div class="activity-meta">
            <strong>Aucune activité récente</strong>
            <span>Les nouveaux messages apparaîtront ici.</span>
          </div>
        </div>
      </div>
      @endforelse

      @foreach($dernieresStatistiques as $stat)
      <div class="activity-item">
        <div class="activity-info">
          <span class="activity-icon project"><i class="fas fa-chart-line"></i></span>
          <div class="activity-meta">
            <strong>Statistique mise à jour</strong>
            <span>{{ $stat->type }} · {{ $stat->cle ?? 'sans clé' }} = {{ $stat->valeur }}</span>
          </div>
        </div>
        <span class="activity-time">{{ $stat->date?->diffForHumans() }}</span>
      </div>
      @endforeach
    </div>
  </aside>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
(function() {
  const ctx = document.getElementById('visitesChart');
  if (!ctx) return;

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan','Fév','Mar','Avr','Mai','Juin'],
      datasets: [{
        label: 'Visites',
        data: [2450, 3100, 4230, 5180, 4750, 5680],
        borderColor: '#2563eb',
        backgroundColor: 'rgba(37, 99, 235, 0.12)',
        borderWidth: 3,
        pointBackgroundColor: '#2563eb',
        pointRadius: 4,
        fill: true,
        tension: 0.4,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(15,23,42,0.92)',
          titleFont: { family: 'Inter', size: 13, weight: '700' },
          bodyFont: { family: 'Inter', size: 12 }
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#64748b', font: { family: 'Inter', size: 12 } }
        },
        y: {
          grid: { color: 'rgba(15,23,42,0.08)' },
          ticks: { color: '#64748b', font: { family: 'Inter', size: 12 } }
        }
      }
    }
  });
})();
</script>
