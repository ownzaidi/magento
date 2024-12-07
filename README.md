# Magento Modules

# Reward point Module.
Integrate a reward points system that allows customers to apply discounts to their orders using reward points fetched from a third-party API. This functionality enables seamless interaction between your system and external services to manage and utilize reward points effectively.

Key Features:
Fetch Reward Points from Third-Party API:

Connect to a third-party API to retrieve a customer's available reward points in real-time.
Ensure secure and efficient API communication for accurate data fetching.
Apply Reward Points for Discounts:

Allow customers to redeem reward points at checkout to reduce the order total.
Dynamically calculate the discount value based on the applied points.
Customer Checkout Integration:

Display available reward points and their corresponding discount value during checkout.
Provide a user-friendly option for customers to select the number of points to apply.
Order Summary Update:

Reflect the discount from reward points in the order total and tax calculations.
Include a summary of applied points and the discount in the order confirmation.
Admin Panel Management:

View and manage reward points usage on customer orders directly from the admin panel.
Include a breakdown of reward points and discounts in the Sales Order Grid.
Seamless API Integration:

Ensure compatibility with various third-party reward systems through customizable API configurations.
Implement error handling to manage API downtime or unavailability.
This feature provides a robust reward points system, enhancing customer engagement and ensuring a smooth checkout experience.


# Cms Page

To retrieve a CMS page by its URL key using an API in Magento 2, you can utilize this module, and you can filter by the URL key.

# Sku issue with Dash

Product is not searhable with sku. If sku contain dash e.g "ab-cd" in magento 2.4.1 p1 

# Website id add in coupon code

Enhance the coupon code functionality by associating each coupon with a Website ID to identify its source. When a coupon is applied, it will validate against the corresponding Website ID and adjust the order total accordingly.

Key Features:
Website ID Association:

Link each coupon code to a specific Website ID.
Ensure coupons are applied only on orders from the matching website.
Validation During Checkout:

Check the Website ID of the order during coupon application.
Prevent invalid coupons from being used on the wrong website.
Dynamic Order Total Adjustment:

Ensure easy tracking of coupons across multiple websites.
Sales Order Tracking:

This feature ensures better organization and control over coupon codes, making it easier to manage promotions across multiple websites.

# Standard Shipping Method

Create a Standard Shipping Method similar to the Flat Rate Shipping Method, allowing you to set a fixed shipping cost per order. This method offers simplicity and consistency in shipping charges, making it easy to configure and manage.

Key Features:
Fixed Shipping Cost:

Set a standard flat shipping rate for all orders, regardless of weight, size, or destination.
Ideal for predictable and straightforward shipping pricing.
Easy Configuration:

Configure the standard shipping rate directly in the admin panel.
Enable or disable the method with a single toggle.
Customer Checkout Integration:

Display the fixed shipping rate as an option during checkout.
Clearly labeled as “Standard Shipping” for customer convenience.
Compatibility:

Works seamlessly with tax rules and other shipping methods.
Can be combined with promotional offers if needed.
This Standard Shipping Method ensures a hassle-free and consistent approach to shipping cost management.
# Vat Field add on checkout

Add a VAT field on the checkout page that applies tax specifically to customers in Germany (DE) or any other configurable country. The VAT field should also be displayed in the Sales Order Grid in the admin panel for easy tracking and management.

Key Features:
VAT Field on Checkout:

Display a VAT field on the checkout page.
Automatically calculate and apply tax for orders from Germany (DE) or any specified country.
Configurable Country Tax Application:

Ensure flexibility to adjust tax rules as needed.
Sales Order Grid Integration:

Show the VAT amount as a separate column in the Sales Order Grid in the admin panel.
Enable quick review and management of VAT charges on all orders.
Accurate Tax Calculations:

Apply the VAT rate correctly to the order total, ensuring compliance with tax regulations.
This feature ensures smooth VAT handling during checkout while providing comprehensive visibility and control in the admin panel.

# Shipping Calculator

Configure shipping rates based on the customer's country and the number of products in their cart. These settings will be easily manageable through the admin panel, allowing administrators to add, modify, or remove rates effortlessly.

Key Features:
Country-Specific Rates:

Set unique shipping rates for each country or group of countries.
Fully customizable to accommodate varying shipping costs by region.
Product Quantity-Based Rates:

Define shipping rates that adjust automatically based on the number of products in the cart.
Support for flexible rate tiers (e.g., 1-5 products, 6-10 products, etc.).
User-Friendly Admin Management:

Easily update shipping rules directly in the admin panel.
Immediate application of changes without requiring additional configurations.
Seamless Checkout Integration:

Ensure accurate shipping rate calculations displayed during checkout and shipping estimates.
This solution offers a flexible, straightforward approach to managing shipping rates, providing both efficiency and adaptability.

# Update Product Prices

Set up a cron job to run every 2 minutes. The job will process a CSV file containing product data, specifically the SKU and price for up to 30 products at a time. It will update the prices of these products in the system.

Once the updates are completed, a "Delete" button will be available to remove the processed file, preparing the system to upload a new file for the next update.

This ensures an efficient, repeatable process for updating product prices with minimal data requirements.
