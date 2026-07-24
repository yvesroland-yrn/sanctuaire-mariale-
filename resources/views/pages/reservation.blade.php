@extends('layouts.app')

@section('title', 'Réservation - ' . config('mudea.brand.name'))

@push('styles')
<style>
    .page-shell {
        max-width: 1200px;
        margin: 0 auto;
        padding: 48px 24px 72px;
    }

    .page-hero {
        background: linear-gradient(135deg, #0b2a57 0%, #1b85d6 55%, #d62828 100%);
        color: #fff;
        border-radius: 28px;
        padding: 34px;
        box-shadow: 0 24px 60px rgba(11, 42, 87, 0.18);
        margin-bottom: 28px;
    }

    .page-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 4vw, 3.1rem);
        line-height: 1.1;
        margin-bottom: 12px;
    }

    .page-hero p {
        max-width: 760px;
        line-height: 1.75;
        color: rgba(255, 255, 255, 0.88);
    }

    .reservation-grid {
        display: grid;
        grid-template-columns: 1.35fr 0.85fr;
        gap: 24px;
        align-items: start;
    }

    .panel {
        background: #fff;
        border: 1px solid #e5eef7;
        border-radius: 24px;
        box-shadow: 0 18px 48px rgba(15, 23, 42, 0.06);
        padding: 26px;
    }

    .panel h2 {
        font-size: 1.2rem;
        margin-bottom: 6px;
    }

    .panel .hint {
        color: #5f7388;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        font-size: 0.92rem;
        font-weight: 700;
        color: #23354a;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        border: 1px solid #d8e4ef;
        border-radius: 14px;
        padding: 14px 16px;
        background: #f7fbff;
        color: #23354a;
        font: inherit;
        transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #1b85d6;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(27, 133, 214, 0.12);
    }

    .form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: none;
        border-radius: 999px;
        background: linear-gradient(135deg, #1b85d6 0%, #d62828 100%);
        color: #fff;
        font-weight: 800;
        padding: 14px 22px;
        min-height: 52px;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 16px 32px rgba(27, 133, 214, 0.22);
    }

    .btn-soft {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: 1px solid #d8e4ef;
        border-radius: 999px;
        background: #fff;
        color: #23354a;
        font-weight: 800;
        padding: 14px 22px;
        min-height: 52px;
        text-decoration: none;
    }

    .side-card {
        position: sticky;
        top: 108px;
    }

    .info-list {
        display: grid;
        gap: 14px;
        margin-top: 18px;
    }

    .info-item {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px;
        border-radius: 16px;
        background: #f7fbff;
        border: 1px solid #e5eef7;
    }

    .info-item strong {
        display: block;
        margin-bottom: 4px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(214, 40, 40, 0.12);
        color: #a61d1d;
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 14px;
    }

    @media (max-width: 960px) {
        .reservation-grid {
            grid-template-columns: 1fr;
        }

        .side-card {
            position: static;
        }
    }

    @media (max-width: 640px) {
        .page-shell {
            padding: 24px 16px 56px;
        }

        .page-hero {
            padding: 24px 20px;
            border-radius: 22px;
        }

        .panel {
            padding: 20px;
            border-radius: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="page-shell">
    <section class="page-hero">
        <span class="badge">Réservation pèlerinage - Paiement de 10 000 FCFA</span>
        <h1>Réserver un pèlerinage</h1>
        <p>
            Les groupes venant en pèlerinage peuvent réserver leur arrivée en ligne.
            Le paiement des frais de réservation déclenche le passage au checkout GeniusPay avant la validation finale du dossier.
        </p>
    </section>

    <div class="reservation-grid">
        <section class="panel">
            <h2>Formulaire de réservation</h2>
            <p class="hint">Remplissez les informations du groupe, puis lancez le paiement sécurisé. La réservation sera finalisée dans l'étape d'administration après confirmation.</p>

            <form action="{{ route('payments.geniuspay.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="amount" value="10000">
                <input type="hidden" name="description" value="Frais de réservation pèlerinage">
                <input type="hidden" name="customer_country" value="{{ old('customer_country', 'CI') }}">

                <div class="form-grid">
                    <div class="form-group">
                        <label for="customer_name">Nom du groupe</label>
                        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" placeholder="Ex: Groupe paroissial Saint Joseph" required>
                    </div>

                    <div class="form-group">
                        <label for="group_responsable">Responsable du groupe</label>
                        <input type="text" name="group_responsable" id="group_responsable" value="{{ old('group_responsable') }}" placeholder="Nom du responsable" required>
                    </div>

                    <div class="form-group">
                        <label for="paroisse">Paroisse</label>
                        <input type="text" name="paroisse" id="paroisse" value="{{ old('paroisse') }}" placeholder="Paroisse d'origine" required>
                    </div>

                    <div class="form-group">
                        <label for="diocese">Diocèse</label>
                        <input type="text" name="diocese" id="diocese" value="{{ old('diocese') }}" placeholder="Diocèse" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre_personnes">Nombre de personnes</label>
                        <input type="number" name="nombre_personnes" id="nombre_personnes" value="{{ old('nombre_personnes') }}" min="1" placeholder="Ex: 25" required>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Téléphone du responsable</label>
                        <input type="text" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" placeholder="+225 07 XX XX XX XX" required>
                    </div>

                    <div class="form-group">
                        <label for="date_arrivee">Date d'arrivée</label>
                        <input type="date" name="date_arrivee" id="date_arrivee" value="{{ old('date_arrivee') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="heure_arrivee">Heure d'arrivée</label>
                        <input type="time" name="heure_arrivee" id="heure_arrivee" value="{{ old('heure_arrivee') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="date_depart">Date de départ</label>
                        <input type="date" name="date_depart" id="date_depart" value="{{ old('date_depart') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="activite">Activité souhaitée</label>
                        <select name="activite" id="activite" required>
                            <option value="">Choisir une activité</option>
                            <option value="messe" @selected(old('activite') === 'messe')>Messe</option>
                            <option value="retreat" @selected(old('activite') === 'retreat')>Retraite spirituelle</option>
                            <option value="adoration" @selected(old('activite') === 'adoration')>Adoration</option>
                            <option value="formation" @selected(old('activite') === 'formation')>Formation / enseignement</option>
                            <option value="autre" @selected(old('activite') === 'autre')>Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="hebergement">Hébergement</label>
                        <select name="hebergement" id="hebergement" required>
                            <option value="non" @selected(old('hebergement', 'non') === 'non')>Non</option>
                            <option value="oui" @selected(old('hebergement') === 'oui')>Oui</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label for="customer_email">Email du responsable</label>
                        <input type="email" name="customer_email" id="customer_email" value="{{ old('customer_email') }}" placeholder="responsable@groupe.com">
                    </div>

                    <div class="form-group full">
                        <label for="comments">Commentaires</label>
                        <textarea name="comments" id="comments" placeholder="Informations complémentaires, heure spéciale, besoins particuliers...">{{ old('comments') }}</textarea>
                    </div>

                </div>

                <div class="actions">
                    <button type="submit" class="btn-submit">Payer les frais de réservation</button>
                    <a href="{{ route('contact') }}" class="btn-soft">Besoin d'aide ?</a>
                </div>
            </form>
        </section>

        
    </div>
</div>
@endsection
