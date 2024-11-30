<div class="row">
    <div class="col-md-6">
        <h6><strong>Name:</strong></h6>
        <p><?= esc($enquiry['name']) ?></p>
    </div>
    <div class="col-md-6">
        <h6><strong>Email:</strong></h6>
        <p><?= esc($enquiry['email']) ?></p>
    </div>
    <div class="col-md-6">
        <h6><strong>Phone:</strong></h6>
        <p><?= esc($enquiry['phone']) ?></p>
    </div>
    <div class="col-md-6">
        <h6><strong>Product:</strong></h6>
        <p><?= esc($enquiry['product_name']) ?></p>
    </div>
    <div class="col-md-12">
        <h6><strong>Message:</strong></h6>
        <p><?= nl2br(esc($enquiry['message'])) ?></p>
    </div>
    <div class="col-md-6">
        <h6><strong>Responded:</strong></h6>
        <p><?= $enquiry['responded'] ? 'Yes' : 'No' ?></p>
    </div>
    <div class="col-md-6">
        <h6><strong>Date:</strong></h6>
        <p><?= esc($enquiry['created_at']) ?></p>
    </div>
</div>
