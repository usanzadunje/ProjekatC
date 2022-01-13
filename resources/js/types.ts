export interface Place {
    /**
     * Place ID
     */
    id: number;
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

export interface User {
    /**
     * Users ID
     */
    id: number;
    /**
     * Users first name
     */
    first_name: string;
    /**
     * Users last name
     */
    last_name: string;
    /**
     * Users username
     */
    username: string;
    /**
     * Users e-mail address
     */
    email?: string;
    /**
     * Place which is owner by user
     */
    place?: Place;
}