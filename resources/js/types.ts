export interface User {
    /**
     * User ID
     */
    id?: number;
    /**
     * User first name
     */
    first_name: string;
    /**
     * User last name
     */
    last_name: string;
    /**
     * User username
     */
    username: string;
    /**
     * User e-mail address
     */
    email?: string;
    /**
     * User avatar image name.
     */
    avatar?: string;
    /**
     * User role
     */
    role?: Role;
}

export interface Place {
    /**
     * Place ID
     */
    id?: number;
    /**
     * Place name
     */
    name: string;
    /**
     * Place city
     */
    city: string;
    /**
     * Place address
     */
    address: string;
    /**
     * ID of the user this place belongs to (owner of the place)
     */
    user_id?: number;
}

export interface Reservation {
    /**
     * Reservation ID
     */
    id?: number;
    /**
     * Date on which reservation should be made
     */
    reservation_date: string;
    /**
     * Date when user asked for reservation
     */
    created_at: string;
    /**
     * Date when reservation was approved by place staff
     */
    approved_at: string;
    /**
     * User which asked for reservation
     */
    reservee?: User;
    /**
     * Place on which reservation was asked for
     */
    place?: Place;
}

declare enum Role {
    /**
     * Indicates admin role
     */
    ADMIN = 1,
    /**
     * Indicates staff role
     */
    STAFF,
    /**
     * Indicates regular user role
     */
    REGULAR,
}

export interface MenuLink {
    /**
     * Display name of menu link
     */
    name: string;
    /**
     * Route name to which this menu link will route to
     */
    route: string;
    /**
     * All the routes that match this link, used for displaying link as active when on these routes
     */
    matchedRoutes: string;
    /**
     * Icon to be shown next to the menu link name
     */
    icon: string;
}