@if($announcements->isNotEmpty())
    @php
        $announcement = $announcements->last();
        $prevAnnouncement = \App\Models\Announcement::where('id', '<', $announcement->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextAnnouncement = \App\Models\Announcement::where('id', '>', $announcement->id)
            ->orderBy('id', 'asc')
            ->first();
    @endphp

    <!-- Modal for Latest Announcement -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header" style="background-color: #AD1457; color: white;">
                    <h5 class="modal-title text-center w-100" id="announcementModalLabel" style="font-size: 28px;">
                        📢 <b>Announcement</b>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="
                        background: none;
                        border: none;
                        font-size: 24px;
                        font-weight: bold;
                        color: red;
                        cursor: pointer;
                        outline: none;
                        box-shadow: none;
                    ">✖</button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- Left Side: Announcement Image -->
                        <div class="col-md-6 text-center">
                            @if($announcement->image)
                                <img src="{{ asset($announcement->image) }}" alt="Announcement"
                                    class="img-fluid rounded" style="max-height: 400px;">
                            @else
                                <img src="{{ asset('assets/img/default-announcement.png') }}" alt="No Image"
                                    class="img-fluid rounded" style="max-height: 400px;">
                            @endif
                        </div>

                        <!-- Right Side: Announcement Details -->
                        <div class="col-md-6">
                            <h4 class="text-center" style="color: #AD1457;">{{ $announcement->title }}</h4>
                            <div class="announcement-bubble" style="
                                background-color: #AD1457;
                                color: white;
                                padding: 25px;
                                border-radius: 15px;
                                font-size: 16px;
                                font-weight: 500;
                                max-width: 90%;
                                margin: 20px auto;
                                text-align: justify;
                                line-height: 1.8;
                                letter-spacing: 0.5px;
                            ">
                                <p>{{ $announcement->message }}</p>
                            </div>
                            <p class="text-muted text-center"><small><i>Published on:
                                    {{ \Carbon\Carbon::parse($announcement->created_at)->format('M d, Y') }}</i></small></p>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer with Prev/Next Buttons -->
                <div class="modal-footer justify-content-between">
                    @if($prevAnnouncement)
                        <a href="{{ route('announcement_details', $prevAnnouncement->id) }}"
                            class="btn btn-secondary btn-sm">Previous</a>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Previous</button>
                    @endif

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Contact Us</button>

                    @if($nextAnnouncement)
                        <a href="{{ route('announcement_details', $nextAnnouncement->id) }}"
                            class="btn btn-secondary btn-sm">Next</a>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Next</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
