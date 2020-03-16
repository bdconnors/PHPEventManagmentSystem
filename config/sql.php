<?php

abstract class SQL{
    const INSERT = "INSERT INTO ";
    const SELECT = "SELECT ";
    const UPDATE = "UPDATE ";
    const DELETE = "DELETE FROM ";

    const FROM = " FROM ";
    const SET = " SET ";
    const WHERE = " WHERE ";

    const begin_columns = " (";
    const end_columns = ") ";

    const begin_values = " VALUES(";
    const end_values = ")";

    const user_table = " attendee ";
    const user_id = " idattendee ";

    const retrieve_all_venues = "SELECT * FROM VENUE";
    const retrieve_all_roles = "SELECT * FROM ROLE";
    const retrieve_all_users ="SELECT * FROM ATTENDEE";
    const retrieve_all_events ="SELECT * FROM EVENT";
    const retrieve_all_sessions = "SELECT * FROM SESSION";
    const retrieve_all_registrations = "SELECT * FROM attendee_event;";
    const retrieve_all_managed_events= "SELECT * FROM manager_event;";

    const create_user = self::INSERT.
        self::user_table.
        self::begin_columns."name,password,role".self::end_columns.
        self::begin_values.":name,:password,:role".self::end_values;

    const retrieve_user = self::retrieve_all_users.self::WHERE;

    const delete_user = self::DELETE.self::user_table.self::WHERE;


}
