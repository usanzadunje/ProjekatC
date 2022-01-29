export type RecursivePartial<T> = {
    [P in keyof T]?: RecursivePartial<T[P]>;
};

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
    role_id?: Role;
}

export interface Auth {
    /**
     * Currently logged-in user or null if guest user
     */
    user?: User | null;
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
    /**
     * Reservation associated with place
     */
    reservation?: Reservation | RegularReservation | StaffReservation;
    /**
     * Services offered by the place
     */
    offers?: Offer[];
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
     * Reservation occasion
     */
    occasion?: string;
    /**
     * Number of guest in the reservation
     */
    number_of_guests?: number;
    /**
     * Additional requirements provided by user
     */
    additional_requirements?: string;
    /**
     * Offers chosen for this reservation
     */
    offers?: Offer[];
    /**
     * User which asked for reservation
     */
    reservee?: User;
    /**
     * Place on which reservation was asked for
     */
    place?: Place;
}

export interface RegularReservation extends Reservation {
    /**
     * ID of the place reservation is for
     */
    placeId?: number;
    /**
     * Name of the place user asked for reservation
     */
    place_name?: string;
    /**
     * Address of the place user asked for reservation
     */
    place_address?: string;
}

export interface StaffReservation extends Reservation {
    /**
     * ID of the user which asked for reservation
     */
    userId: number;
    /**
     * First name of the user which asked for reservation
     */
    user_first_name: string;
    /**
     * Last name of the user which asked for reservation
     */
    user_last_name: string;
    /**
     * E-mail address of the user which asked for reservation
     */
    user_email: string;
}

export enum Role {
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
     * All strings that match this link starting route URL, used for displaying link as active when on these URLs
     */
    matchedURLs?: string[];
    /**
     * Icon to be shown next to the menu link name
     */
    icon?: string;
}

export interface Paginator {
    /**
     * Pagination object containing page urls
     */
    pagination: Pagination;
    /**
     * Query string attached to at the end of paginator urls
     */
    queries?: object;
}

export interface Pagination {
    /**
     * Url to the first page of paginated results
     */
    first_page_url: string;
    /**
     * Url to next page of paginated results
     */
    next_page_url: string;
    /**
     * Url to previous page of paginated results
     */
    prev_page_url: string;
}

export interface Offer {
    /**
     * Offer ID
     */
    id?: number;
    /**
     * Name of the service provided through offer. (by place)
     */
    name: string;
}
